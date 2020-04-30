<?php


namespace Fetchtex\FAQs\Ui\Component\Listing\Column;


use Magento\Ui\Component\Listing\Columns\Column;

class Actions extends Column
{


    public function prepareDataSource( array $dataSource )
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                // here we can also use the data from $item to configure some parameters of an action URL
                $item[$this->getData('name')] = [
                    'edit' => [
                        'href' => $this->context->getUrl('fetchtex_faqs/faqs/edit', ['entity_id' => $item["entity_id"]]),
                        'label' => __('Edit')
                    ],
                    'remove' => [
                        'href' => "../remove/entity_id/" . $item["entity_id"],
                        'label' => __('Remove')
                    ]
                ];
            }
        }

        return $dataSource;
    }
}
