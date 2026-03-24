## Trying to understand:

- Views: What the user sees
- Scripts: Frontend stuff + bridge data to the controller
- Controller: Passively updates the front/backend by interacting with management/bl
- Models:Database access, direct functionality with db
- Management/business logic: actually commands the data interaction between site and database

* CRUD Operations on all tables except user roles, room status, sched type

* registrations are always accepted by the system

- must collect all types of user data, and dont delete user data

* Public view: Anyone can access, can see sign in
* Student view: Can request to reserve a room, can logout, user accpunt (change info)
* Admin view: See dashboard (graphs, tables, cards)

Data to collect:

- Username
- First Name
- Last Name
- School ID number
- Role
- Phone number
- Home address
- Email
- Birthdate

WebApp conditions:

- Admin cannot change any user data
- New Users cannot apply for admin

# April 1: Video Presentation

- Zip the code
- Compile Database schema inside zip file
