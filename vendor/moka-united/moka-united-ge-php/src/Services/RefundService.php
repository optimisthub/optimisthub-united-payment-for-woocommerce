<?php

namespace MokaUnitedGE\Services;

class RefundService extends AbstractService
{
    /**
     * @param array $data
     * @return \MokaUnitedGE\Http\Response
     */
    public function create(array $data)
    {
        return $this->request('POST', '/PaymentDealer/DoCreateRefundRequest', [
            'PaymentDealerAuthentication' => $this->getAuthorizationParams(),
            'PaymentDealerRequest' => $data,
        ]);
    }
}
