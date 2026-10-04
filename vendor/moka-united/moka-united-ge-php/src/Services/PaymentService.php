<?php

namespace MokaUnitedGE\Services;

use MokaUnitedGE\Http\Response;

class PaymentService extends AbstractService
{
    /**
     * @param array $data
     * @return Response
     */
    public function all(array $data): Response
    {
        return $this->request('POST', '/PaymentDealer/GetPaymentList', [
            'PaymentDealerAuthentication' => $this->getAuthorizationParams(),
            'PaymentDealerRequest' => $data,
        ]);
    }

    /**
     * @param array $data
     * @return Response
     */
    public function approval(array $data): Response
    {
        return $this->request('POST', '/PaymentDealer/DoApprovePoolPayment', [
            'PaymentDealerAuthentication' => $this->getAuthorizationParams(),
            'PaymentDealerRequest' => $data,
        ]);
    }

    /**
     * @param array $data
     * @return Response
     */
    public function cancelApproval(array $data): Response
    {
        return $this->request('POST', '/PaymentDealer/UndoApprovePoolPayment', [
            'PaymentDealerAuthentication' => $this->getAuthorizationParams(),
            'PaymentDealerRequest' => $data,
        ]);
    }

    /**
     * @param array $data
     * @return Response
     */
    public function cancel(array $data): Response
    {
        return $this->request('POST', '/PaymentDealer/DoVoid', [
            'PaymentDealerAuthentication' => $this->getAuthorizationParams(),
            'PaymentDealerRequest' => $data,
        ]);
    }

    /**
     * @param array $data
     * @return Response
     */
    public function capture(array $data): Response
    {
        return $this->request('POST', '/PaymentDealer/DoCapture', [
            'PaymentDealerAuthentication' => $this->getAuthorizationParams(),
            'PaymentDealerRequest' => $data,
        ]);
    }

    /**
     * @param array $data
     * @return Response
     */
    public function create(array $data): Response
    {
        return $this->request('POST', '/PaymentDealer/DoDirectPaymentThreeDGE', [
            'PaymentDealerAuthentication' => $this->getAuthorizationParams(),
            'PaymentDealerRequest' => $data,
        ]);
    }

    /**
     * @param array $data
     * @return Response
     */
    public function retrieve(array $data): Response
    {
        return $this->request('POST', '/PaymentDealer/GetDealerPaymentTrxDetailList', [
            'PaymentDealerAuthentication' => $this->getAuthorizationParams(),
            'PaymentDealerRequest' => $data,
        ]);
    }

    /**
     * @param array $data
     * @return Response
     */
    public function retrieveAmount(array $data): Response
    {
        return $this->request('POST', '/PaymentDealer/DoCalcPaymentAmount', [
            'PaymentDealerAuthentication' => $this->getAuthorizationParams(),
            'PaymentDealerRequest' => $data,
        ]);
    }

    /**
     * @param array $data
     * @return Response
     */
    public function update(array $data): Response
    {
        return $this->request('POST', '/PaymentDealer/UpdateDealerPayment', [
            'PaymentDealerAuthentication' => $this->getAuthorizationParams(),
            'PaymentDealerRequest' => $data,
        ]);
    }
}
