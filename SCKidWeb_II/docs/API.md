#API Usage:

**Sync**
----
  <_Additional information about your API call. Try to use verbs that match both request type (fetching vs modifying) and plurality (one vs multiple)._>

* **URL**

  _/api/v1/sync_

* **Method:**
  
  <_GET_>

*  **URL Params**

   <_If URL params exist, specify them in accordance with name mentioned in URL section. Separate into optional and required. Document data constraints._> 

   **Required:**
 
   `last_update=[time]`
   eg. `last_update=2016-06-08 05:04:32`

   **Optional:**
 
   `other=[alphanumeric]`

* **Data Params**

  <_If making a post request, what should the body payload look like? URL Params rules apply here too._>

* **Success Response:**
  
  <_What should the status code be on success and is there any returned data? This is useful when people need to to know what their callbacks should expect!_>

  * **Code:** 200 <br />
    **Content:** `{ id : 12 }`
 
* **Error Response:**

  <_Most endpoints will have many ways they can fail. From unauthorized access, to wrongful parameters etc. All of those should be liste d here. It might seem repetitive, but it helps prevent assumptions from being made where they should be._>

  * **Code:** 401 UNAUTHORIZED <br />
    **Content:** `{ error : "Log in" }`

  OR

  * **Code:** 422 UNPROCESSABLE ENTRY <br />
    **Content:** `{ error : "Email Invalid" }`

* **Sample Call:**

  <_Just a sample call to your endpoint in a runnable format ($.ajax call or a curl request) - this makes life easier and more predictable._>

* **Notes:**

  <_This is where all uncertainties, commentary, discussion etc. can go. I recommend timestamping and identifying oneself when leaving comments here._> 
  
**POST SMS**
----
  _Pushes all SMS from mobile device according to the kid who needs to be updated_

* **URL**

  _/api/v1/calls_

* **Method:**
  
  _POST_
  
*  **URL Params**

   **Required:**
 
 _Kid id:_
   `id=[integer]`

   **Optional:**
 
   `type filter=[alphanumeric]`

* **Data Params**

_Header:_ `Authorization`  
Value: `Bearer <token_value>`  
Header: `Content-Type`  
Value: `application/json`  

* **Success Response:**
  
  * **Code:** 200 <br />
    **Content:** `{ error : false|true websites: {name: [string], host: [string] }}`
 
* **Error Response:**

  * **Code:** 401 UNAUTHORIZED <br />
    **Content:** `{ message : "Log in" }`

  OR

  * **Code:** 422 UNPROCESSABLE ENTRY <br />
    **Content:** `{ error : "Email Invalid" }`

* **Sample Call:**    

```
  {
	"kid": {
		"id": "1",
		"sms": [{
			"number": "675-379-5469",
			"contact": "JSON",
			"content": "This is a sms message 1",
			"direction": "0",
			"time": "1983-10-20 07:08:41"
		}, {
			"number": "675-379-546fd",
			"contact": "JSON1",
			"content": "This is a sms message 2",
			"direction": "1",
			"time": "1983-10-20 07:08:41"
		}]
	}
}
```

* **Notes:**

  <_This is where all uncertainties, commentary, discussion etc. can go. I recommend timestamping and identifying oneself when leaving comments here._> 
