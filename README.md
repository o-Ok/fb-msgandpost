# fb-msgandpost
Manage your facebook page messaging with predefind anwers with dependencies and automaticly post on message command.


1. Connect your facebook page messaging api
2. Define the messaging commands/questions/answers
3. Define page behaveour depending on the commands like posting image, tagging the person who messaged your page etc. 


The main idea is to create a facebook page for ride sharing. 
The person who offers a ride messages the Page with the details (place of departure, time, free seats and destination), then the page posts an image with the city of departure, time of departure, destination city and free seats on the ride. 

The person looking for a ride messages the page with the details of the request (departure city, time, alone or with friends and destination), then the page relays the info and looks up if there is a ride for the time window defined and if there is a match it responds with the details of the offered ride and creates a message reminder before the pickup time for the driver and the passenger. If there is no ride offer the page creates a post with a ride request with the details.

All using the messenger platform and a facebook page.
