## Yumfood API

### Get Vendors

-   **URL**
    `/vendors`

-   **Method**
    `GET`

-   **Success Response**
    -   **Status Code**
        `200`
    -   **Content**
        ```json
          {
            "data": [
              {
                "id": "<Vendor's Id>",
                "name": "<Vendor's name>",
                "logo" : "<Vendor's logo>",
                "tags": [
                  {
                    "id": "<Tag's Id>",
                    "name": "<Tag's name>"
                  },
                  ...
                ]
              }
            ]
          }
        ```
-   **Sample Call:**

    `<base url>/api/v1/vendors`

### Get Filtered Vendors

-   **URL**
    `/vendors?tags[]=<tags name>`

-   **Method**
    `GET`

-   **Success Response**
    -   **Status Code**
        `200`
    -   **Content**
        ```json
          {
            "data": [
              {
                "id": "<Vendor's Id>",
                "name": "<Vendor's name>",
                "logo" : "<Vendor's logo>",
                "tags": [
                  {
                    "id": "<Tag's Id>",
                    "name": "<Tag's name>"
                  },
                  ...
                ]
              }
            ]
          }
        ```
-   **Sample Call:**

    `<base url>/api/v1/vendors?tags=promo&tags[]=featured`

### Get Dishes By Vendor Id

-   **URL**
    `/vendors/<vendor id>/dishes`

-   **Method**
    `GET`

-   **Success Response**
    -   **Status Code**
        `200`
    -   **Content**
        ```json
        [
            {
                "id": "<Dish id>",
                "vendor_id": "<Vendor id>",
                "name": "<Dish name>",
                "price": "<Dish price>",
                "created_at": "<Dish timestamp>",
                "updated_at": "<Dish timestamp>"
            },
            ...
        ]
        ```
-   **Sample Call:**

    `<base url>/api/v1/vendors/<vendor id>/dishes`

### Get Vendor By Vendor Id

-   **URL**
    `/vendors/<vendor id>`

-   **Method**
    `GET`

-   **Success Response**
    -   **Status Code**
        `200`
    -   **Content**
        ```json
          {
            "data": {
              {
                "id": "<Vendor's Id>",
                "name": "<Vendor's name>",
                "logo" : "<Vendor's logo>",
                "tags": [
                  {
                    "id": "<Tag's Id>",
                    "name": "<Tag's name>"
                  },
                  ...
                ]
              }
            }
          }
        ```
-   **Error Response:**
    -   404 Data Not Found
        ```json
        {
            "statusCode": 404,
            "message": "Sorry. Data not found"
        }
        ```
-   **Sample Call:**

    `<base url>/api/v1/vendors/<vendor id>`

### Create a Vendor

-   **URL**
    `/vendors`

-   **Method**
    `POST`

-   **Data Params**

    ```json
    {
        "name": "<Vendor's name>",
        "logo": "<Vendor's logo>",
        "tags": "<Vendor's tag1>, <Vendor's tag2>"
    }
    ```

-   **Success Response**
    -   **Status Code**
        `200`
    -   **Content**
        ```json
        {
            "statusCode": 200,
            "message": "Success. Sadgesdsd successfully added."
        }
        ```
-   **Error Response:**
    -   422 Unprocessable Entity
        ```json
        {
            "message": "The given data was invalid.",
            "errors": {
                "<field's name>": ["<field's name> is required"]
            }
        }
        ```
-   **Sample Call:**

    `<base url>/api/v1/vendors`

### Edit a Vendor by Id

-   **URL**
    `/vendors/<vendor id>`

-   **Method**
    `PUT`

-   **Data Params**

    ```json
    {
        "name": "<Vendor's name>",
        "logo": "<Vendor's logo>",
        "tags": "<Vendor's tag1>, <Vendor's tag2>"
    }
    ```

-   **Success Response**
    -   **Status Code**
        `200`
    -   **Content**
        ```json
        {
            "statusCode": 200,
            "message": "Success. <vendor name> successfully changed."
        }
        ```
-   **Error Response:**
    -   422 Unprocessable Entity
        ```json
        {
            "message": "The given data was invalid.",
            "errors": {
                "<field's name>": ["<field's name> is required"]
            }
        }
        ```
    -   404 Data not found
        ```json
        {
            "statusCode": 404,
            "message": "Sorry. Data not found"
        }
        ```
-   **Sample Call:**

    `<base url>/api/v1/vendors/<vendor id>`

### Delete a Vendor by Id

-   **URL**
    `/vendors/<vendor id>`

-   **Method**
    `DELETE`

-   **Success Response**
    -   **Status Code**
        `200`
    -   **Content**
        ```json
        {
            "statusCode": 200,
            "message": "Success. <vendor name> successfully deleted."
        }
        ```
-   **Error Response:**
    -   404 Data not found
        ```json
        {
            "statusCode": 404,
            "message": "Sorry. Data not found"
        }
        ```
-   **Sample Call:**

    `<base url>/api/v1/vendors/<vendor id>`
