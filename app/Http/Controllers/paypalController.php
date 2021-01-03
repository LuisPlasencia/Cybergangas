<?php

namespace App\Http\Controllers;

use App\Facturas;
use App\Ordenes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Exception\PayPalConnectionException;
use PayPal\Rest\ApiContext;

class paypalController extends Controller
{
    private $apiContext;

    public function __construct()
    {
        $payPalConfig = Config::get('paypal');

        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                $payPalConfig['client_id'],
                $payPalConfig['secret']
            )
        );

        $this->apiContext->setConfig($payPalConfig['settings']);
    }

    // ...

    public function payWithPayPal()
    {
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $cantidad = session('cantidadFinal');
        $amount = new Amount();
        $amount->setTotal($cantidad);
        $amount->setCurrency('EUR');

        $transaction = new Transaction();
        $transaction->setAmount($amount);
        // $transaction->setDescription('See your IQ results');

        $callbackUrl = url('/paypal/status');

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl($callbackUrl)
            ->setCancelUrl($callbackUrl);

        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions(array($transaction))
            ->setRedirectUrls($redirectUrls);

        try {
            $payment->create($this->apiContext);
            return redirect()->away($payment->getApprovalLink());
        } catch (PayPalConnectionException $ex) {
            echo $ex->getData();
        }
    }

    public function payPalStatus(Request $request)
    {
        $paymentId = $request->input('paymentId');
        $payerId = $request->input('PayerID');
        $token = $request->input('token');

        if (!$paymentId || !$payerId || !$token) {
            $status = 'Lo sentimos! El pago a través de PayPal no se pudo realizar.';
            return redirect('/resultsPay')->with(compact('status'));
        }

        $payment = Payment::get($paymentId, $this->apiContext);
        $transaction = $payment->getTransactions();
        $amount = $transaction[0]->getAmount()->getTotal();
        $email= $payment->getPayer()->getPayerInfo()->getEmail();
        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

        /** Execute the payment **/
        $result = $payment->execute($execution, $this->apiContext);

        if ($result->getState() === 'approved') {

            //Si se paga... cambiamos el estado de pending a paid
            $orderID = session('orderID');
            $invoiceID = session('invoiceID');

            session(['vaciarCarritoDespuesDeCompra'=> true]);

            Ordenes::where('id',$orderID)->update(array('estado'=>'Enviado'));
            Facturas::where('id',$invoiceID)->update(array('estado'=>'pagado'));

            session()->forget($orderID);
            session()->forget($invoiceID);

            $status = 'Gracias! El pago a través de PayPal se ha realizado correctamente.';
            return redirect('/resultsPay')->with(compact('status'));
        }
        $status = 'Lo sentimos! El pago a través de PayPal no se pudo realizar.';
        return redirect('/resultsPay')->with(compact('status'));
    }
}
