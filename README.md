# Magento 2 GraphQL Custom Module

This repository contains a **Magento 2 custom module** that demonstrates how to implement **GraphQL** in Magento for exposing custom data through a flexible and scalable API.

## Key Features

- Custom GraphQL schema implementation
- Custom GraphQL resolver
- Single `/graphql` endpoint usage
- Clean, extensible, and Magento-standard compliant structure
- Ideal for headless & API-driven Magento projects

## Requirements

- Magento Open Source or Adobe Commerce **2.3.0+**
- PHP **7.2+**
- GraphQL enabled (default in Magento 2.3+)

## Module Information

- **Module Name:** `Ashok_CustomerGraphQl` *(rename as needed)*
- **Module Type:** Magento 2 Custom Module
- **API Type:** GraphQL

## Installation

1. Copy the module to Magento:

```
app/code/Ashok/CustomerGraphQl
```

2. Run Magento commands:

```bash
php bin/magento setup:upgrade
php bin/magento setup:di:compile
php bin/magento cache:flush
php bin/magento setup:static-content:deploy
```

## GraphQL Endpoint
After installation, the GraphQL endpoint is available at:
```
https://your-magento-site.com/graphql
```

## GraphQL Schema Example
File: `etc/schema.graphqls`

```
type CustomerDetailsOutput {
    id: Int
    firstname: String
    lastname: String
    email: String
}

type Query {
    customerDetails: CustomerDetailsOutput 
        @resolver(class: "Ashok\\CustomerGraphQl\\Model\\Resolver\\CustomerDetails")
}
```

## Example GraphQL Query
### Generate Customer Token
```
mutation {
  generateCustomerToken(email: "ashokdubaria@gmail.com", password: "Ashok123#") {
    token
  }
}
```
### Add Header
```
Authorization: Bearer <customer-token>
```
### Execute Customer Details Query
```
query {
    customerDetails {
        id
        firstname
        email
    }
}
```
### Example Response of Customer Details Query
```
{
  "data": {
    "customerDetails": {
      "id": 1,
      "firstname": "Ashok",
      "email": "ashokdubaria@gmail.com"
    }
  }
}
```