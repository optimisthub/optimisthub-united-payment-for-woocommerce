<?php

namespace MokaUnitedGE\Services;

class CardService extends AbstractService
{
    /**
     * @param array $data
     * @return \MokaUnitedGE\Http\Response
     */
    public function all(array $data)
    {
        return $this->request('POST', '/DealerCustomer/GetCardList', [
            'DealerCustomerAuthentication' => $this->getAuthorizationParams(),
            'DealerCustomerRequest' => $data,
        ]);
    }

    /**
     * @param array $data
     * @return \MokaUnitedGE\Http\Response
     */
    public function create(array $data)
    {
        return $this->request('POST', '/DealerCustomer/AddCard', [
            'DealerCustomerAuthentication' => $this->getAuthorizationParams(),
            'DealerCustomerRequest' => $data,
        ]);
    }

    /**
     * @param array $data
     * @return \MokaUnitedGE\Http\Response
     */
    public function retrieve(array $data)
    {
        return $this->request('POST', '/DealerCustomer/GetCard', [
            'DealerCustomerAuthentication' => $this->getAuthorizationParams(),
            'DealerCustomerRequest' => $data,
        ]);
    }

    /**
     * @param array $data
     * @return \MokaUnitedGE\Http\Response
     */
    public function update(array $data)
    {
        return $this->request('POST', '/DealerCustomer/UpdateCard', [
            'DealerCustomerAuthentication' => $this->getAuthorizationParams(),
            'DealerCustomerRequest' => $data,
        ]);
    }

    /**
     * @param array $data
     * @return \MokaUnitedGE\Http\Response
     */
    public function delete(array $data)
    {
        return $this->request('POST', '/DealerCustomer/RemoveCard', [
            'DealerCustomerAuthentication' => $this->getAuthorizationParams(),
            'DealerCustomerRequest' => $data,
        ]);
    }
}
