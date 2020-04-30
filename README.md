# Magento 2 FAQ GraphQL Module

Hereby FAQ module provides to list FAQs with the categories. FAQs can be added through `Content > FAQ` section. 

Graphql requests are used by frontend with only search functionality. Requests are sent by apollo-boost using GET method
so that they can be cached on backend.  

## Install Module

```
composer require fetchtex/module-faq

bin/magento module:enable Fetchtex_FAQs
bin/magento setup:upgrade
```

## Sample Request 

```graphql
query myFaq {
  allfaqs(filter: { question:"%Wha%"}) {
    items {
      question
      answer
      category{
        id
        name
      }
    }
    total_count
  }
}
```
tested with Magento CE 2.3.4


![](https://media.giphy.com/media/Mc0O3BrnIzl7PfbLyb/giphy.gif)

