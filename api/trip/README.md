# Trip API

Trip API contains operations for allocating trips and updating trips' status.


<details><summary>Requesting a trip</summary>

## Requesting a trip:

### ENDPOINT
`[website base address]/api/trip/request.php`

### REQUEST DETAILS

#### Request Method:
`POST`

#### Request Body:
|Member|Data Type|Comment|
|--|--|--|
|vehicletype|string|Vehicle type for the trip. Values could be "Sedan", "Compact", "Van", "SUV", or "Limousine"|
|passengerid|numeric||
|source|string|Current location - name \ address|
|sourcelat|decimal|Current location - latitude|
|sourcelong|decimal|Current location - longitude|
|destination|string|Destination location - name \ address|
|destinationlat|decimal|Destination location - latitude|
|destinationlong|decimal|Destination location - longitude|
|radius|numeric|Optional. Sets the radius where available vehicles should be searched - default is 20 (20 km radius)|

### RESPONSE DETAILS

#### Response Status Codes:
|Status|Description|
|--|--|
|201|Created|
|400|Bad Request|
|405|Method Not Allowed|
|500|Internal Server Error|

#### Response Body:
|Member|Data Type|Comment|
|--|--|--|
|message|string||
|id|numeric|The trip id. Present only if operation is successful|

### SAMPLES

#### Sample Request:
~~~~
POST [website base address]/api/trip/request.php HTTP/1.1
Content-Type: application/json

{
    "vehicletype": "Sedan",
    "passengerid": 1,
    "source": "Don Pablo Bldg, 114 Amorsolo Street, Legazpi Village, Makati, Kalakhang Maynila, Philippines",
    "sourcelat": 14.556764,
    "sourcelong": 121.014685,
    "destination": "San Agustin Church, General Luna St, Manila, Metro Manila, Philippines",
    "destinationlat": 14.58899,
    "destinationlong": 120.975238
}
~~~~

#### Sample Response:
~~~~
Access-Control-Allow-Methods: POST
Access-Control-Allow-Orgin: *
Connection: close
Content-Type: application/json; charset=UTF-8
Date: Fri, 30 Mar 2018 09:00:57 +0000
Location: /api/trip/get.php?id=1
Status: 201

{
    "message": "Trip requested and a vehicle was assigned to it.",
    "id": 1
}
~~~~


</details>


<details><summary>Getting a trip (Detailed Response)</summary>

## Getting a trip (Detailed Response):

### ENDPOINT
`[website base address]/api/trip/get.php`

### REQUEST DETAILS

#### Request Method:
`GET`

#### Request Parameter:
|Name|Description|
|--|--|
|id|Id of the trip|

### RESPONSE DETAILS

#### Response Status Codes:
|Status|Description|
|--|--|
|200|Success|
|400|Bad Request|
|404|Not Found|
|405|Method Not Allowed|
|500|Internal Server Error|

#### Response Body:
|Member|Data Type|Comment|
|--|--|--|
|id |numeric||
|vehicleid|numeric||
|passengerid|string||
|source|string|Source location|
|sourcelat|decimal|Source location - latitude|
|sourcelong|decimal|Source location - longitude|
|destination|string|Destination location|
|destinationlat|decimal|Destination location - latitude|
|destinationlong|decimal|Destination location - longitude|
|stage|string|Trip's stage|
|datestart|datetime||
|dateend|datetime||
|datecreated|datetime||
|datemodified|datetime||

### SAMPLES

#### Sample Request:
~~~~
GET [website base address]/api/trip/get.php?id=1 HTTP/1.1 
~~~~

#### Sample Response:
~~~~
Access-Control-Allow-Methods: GET
Access-Control-Allow-Orgin: *
Connection: close
Content-Type: application/json; charset=UTF-8
Date: Fri, 30 Mar 2018 09:04:57 +0000
Status: 200

{
    "id": 1,
    "vehicleid": 1,
    "passengerid": 1,
    "source": "Don Pablo Bldg, 114 Amorsolo Street, Legazpi Village, Makati, Kalakhang Maynila, Philippines",
    "sourcelat": 14.556764,
    "sourcelong": 121.014685,
    "destination": "San Agustin Church, General Luna St, Manila, Metro Manila, Philippines",
    "destinationlat": 14.58899,
    "destinationlong": 120.975238,
    "stage": "Accepted",
    "datestart": null,
    "dateend": null,
    "datecreated": "2018-03-30 07:38:22",
    "datemodified": "2018-03-30 09:09:36"
}
~~~~


</details>


<details><summary>Getting trips by stage (and vehicle id and \ or date range)</summary>

## Getting trips by stage (and vehicle id and \ or date range):

### ENDPOINT
`[website base address]/api/trip/get.php`

### REQUEST DETAILS

#### Request Method:
`GET`

#### Request Parameter:
|Name|Description|
|--|--|
|stage|Stage of the trip (Could be "Requested", "Assigned", "Accepted", "Rejected", "Ongoing", "Completed", "Cancelled", or "%")|
|vehicleid|Optional|
|datestart|Optional. Date coverage start|
|dateend|Optional. Date coverage end|

### RESPONSE DETAILS

#### Response Status Codes:
|Status|Description|
|--|--|
|200|Success|
|400|Bad Request|
|405|Method Not Allowed|
|500|Internal Server Error|

#### Response Body:
**Array of:**

|Member|Data Type|Comment|
|--|--|--|
|id |numeric||
|vehicleid|numeric||
|passengerid|string||
|sourcelat|decimal|Source location - latitude|
|sourcelong|decimal|Source location - longitude|
|destinationlat|decimal|Destination location - latitude|
|destinationlong|decimal|Destination location - longitude|
|stage|string|Trip's stage|

### SAMPLES

#### Sample Request:
~~~~
GET [website base address]/api/trip/get.php?stage=Assigned&vehicleid=1 HTTP/1.1 
~~~~

#### Sample Response:
~~~~
Access-Control-Allow-Methods: GET
Access-Control-Allow-Orgin: *
Connection: close
Content-Type: application/json; charset=UTF-8
Date: Fri, 30 Mar 2018 09:14:11 +0000
Status: 200

[
    {
        "id": 1,
        "vehicleid": 1,
        "passengerid": 1,
        "sourcelat": 14.556764,
        "sourcelong": 121.014685,
        "destinationlat": 14.58899,
        "destinationlong": 120.975238,
        "stage": "Assigned"
    }
]
~~~~


</details>


<details><summary>Manually assigning a trip</summary>

## Manually assigning a trip:

### ENDPOINT
`[website base address]/api/trip/assign.php`

### REQUEST DETAILS

#### Request Method:
`POST`

#### Request Body:
|Member|Data Type|Comment|
|--|--|--|
|id|numeric|Trip id|
|vehicleid|numeric||

### RESPONSE DETAILS

#### Response Status Codes:
|Status|Description|
|--|--|
|200|Success|
|400|Bad Request|
|405|Method Not Allowed|
|500|Internal Server Error|

#### Response Body:
|Member|Data Type|Comment|
|--|--|--|
|message|string||
|id|numeric|The trip id. Present only if operation is successful|

### SAMPLES

#### Sample Request:
~~~~
POST [website base address]/api/trip/assign.php HTTP/1.1
Content-Type: application/json

{
    "id": 1,
    "vehicleid": 1
}
~~~~

#### Sample Response:
~~~~
Access-Control-Allow-Methods: POST
Access-Control-Allow-Orgin: *
Connection: close
Content-Type: application/json; charset=UTF-8
Date: Fri, 30 Mar 2018 09:33:42 +0000
Status: 200

{
    "message": "Trip assigned.",
    "id": 1
}
~~~~


</details>


<details><summary>Accepting a trip</summary>

## Accepting a trip:

### ENDPOINT
`[website base address]/api/trip/accept.php`

### REQUEST DETAILS

#### Request Method:
`POST`

#### Request Body:
|Member|Data Type|Comment|
|--|--|--|
|id|numeric|Trip id|

### RESPONSE DETAILS

#### Response Status Codes:
|Status|Description|
|--|--|
|200|Success|
|400|Bad Request|
|405|Method Not Allowed|
|500|Internal Server Error|

#### Response Body:
|Member|Data Type|Comment|
|--|--|--|
|message|string||
|id|numeric|The trip id. Present only if operation is successful|

### SAMPLES

#### Sample Request:
~~~~
POST [website base address]/api/trip/accept.php HTTP/1.1
Content-Type: application/json

{
    "id": 1
}
~~~~

#### Sample Response:
~~~~
Access-Control-Allow-Methods: POST
Access-Control-Allow-Orgin: *
Connection: close
Content-Type: application/json; charset=UTF-8
Date: Fri, 30 Mar 2018 09:09:36 +0000
Status: 200

{
    "message": "Trip accepted.",
    "id": 1
}
~~~~


</details>


<details><summary>Rejecting a trip</summary>

## Rejecting a trip:

### ENDPOINT
`[website base address]/api/trip/reject.php`

### REQUEST DETAILS

#### Request Method:
`POST`

#### Request Body:
|Member|Data Type|Comment|
|--|--|--|
|id|numeric|Trip id|

### RESPONSE DETAILS

#### Response Status Codes:
|Status|Description|
|--|--|
|200|Success|
|400|Bad Request|
|405|Method Not Allowed|
|500|Internal Server Error|

#### Response Body:
|Member|Data Type|Comment|
|--|--|--|
|message|string||
|id|numeric|The trip id. Present only if operation is successful|

### SAMPLES

#### Sample Request:
~~~~
POST [website base address]/api/trip/reject.php HTTP/1.1
Content-Type: application/json

{
    "id": 1
}
~~~~

#### Sample Response:
~~~~
Access-Control-Allow-Methods: POST
Access-Control-Allow-Orgin: *
Connection: close
Content-Type: application/json; charset=UTF-8
Date: Fri, 30 Mar 2018 10:12:29 +0000
Status: 200

{
    "message": "Trip rejected.",
    "id": 1
}
~~~~


</details>


<details><summary>Starting a trip</summary>

## Starting a trip:

### ENDPOINT
`[website base address]/api/trip/start.php`

### REQUEST DETAILS

#### Request Method:
`POST`

#### Request Body:
|Member|Data Type|Comment|
|--|--|--|
|id|numeric|Trip id|

### RESPONSE DETAILS

#### Response Status Codes:
|Status|Description|
|--|--|
|200|Success|
|400|Bad Request|
|405|Method Not Allowed|
|500|Internal Server Error|

#### Response Body:
|Member|Data Type|Comment|
|--|--|--|
|message|string||
|id|numeric|The trip id. Present only if operation is successful|

### SAMPLES

#### Sample Request:
~~~~
POST [website base address]/api/trip/start.php HTTP/1.1
Content-Type: application/json

{
    "id": 1
}
~~~~

#### Sample Response:
~~~~
Access-Control-Allow-Methods: POST
Access-Control-Allow-Orgin: *
Connection: close
Content-Type: application/json; charset=UTF-8
Date: Fri, 30 Mar 2018 10:15:05 +0000
Status: 200

{
    "message": "Trip started.",
    "id": 1
}
~~~~


</details>


<details><summary>Ending a trip</summary>

## Ending a trip:

### ENDPOINT
`[website base address]/api/trip/end.php`

### REQUEST DETAILS

#### Request Method:
`POST`

#### Request Body:
|Member|Data Type|Comment|
|--|--|--|
|id|numeric|Trip id|

### RESPONSE DETAILS

#### Response Status Codes:
|Status|Description|
|--|--|
|200|Success|
|400|Bad Request|
|405|Method Not Allowed|
|500|Internal Server Error|

#### Response Body:
|Member|Data Type|Comment|
|--|--|--|
|message|string||
|id|numeric|The trip id. Present only if operation is successful|

### SAMPLES

#### Sample Request:
~~~~
POST [website base address]/api/trip/end.php HTTP/1.1
Content-Type: application/json

{
    "id": 1
}
~~~~

#### Sample Response:
~~~~
Access-Control-Allow-Methods: POST
Access-Control-Allow-Orgin: *
Connection: close
Content-Type: application/json; charset=UTF-8
Date: Fri, 30 Mar 2018 10:16:00 +0000
Status: 200

{
    "message": "Trip ended.",
    "id": 1
}
~~~~


</details>


<details><summary>Cancelling a trip</summary>

## Ending a trip:

### ENDPOINT
`[website base address]/api/trip/cancel.php`

### REQUEST DETAILS

#### Request Method:
`POST`

#### Request Body:
|Member|Data Type|Comment|
|--|--|--|
|id|numeric|Trip id|

### RESPONSE DETAILS

#### Response Status Codes:
|Status|Description|
|--|--|
|200|Success|
|400|Bad Request|
|405|Method Not Allowed|
|500|Internal Server Error|

#### Response Body:
|Member|Data Type|Comment|
|--|--|--|
|message|string||
|id|numeric|The trip id. Present only if operation is successful|

### SAMPLES

#### Sample Request:
~~~~
POST [website base address]/api/trip/cancel.php HTTP/1.1
Content-Type: application/json

{
    "id": 1
}
~~~~

#### Sample Response:
~~~~
Access-Control-Allow-Methods: POST
Access-Control-Allow-Orgin: *
Connection: close
Content-Type: application/json; charset=UTF-8
Date: Fri, 30 Mar 2018 10:18:10 +0000
Status: 200

{
    "message": "Trip cancelled.",
    "id": 1
}
~~~~


</details>
