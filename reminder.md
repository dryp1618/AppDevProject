# Industry-standard file-structure:

- Views: What the user sees
- Scripts: Frontend manager & functionality + bridge data to the controller
- Controller: Passively updates the front/backend by interacting with management/bl (who knows the user may want to add and delete at the same time)
- Management/Business Logic: Commands the data interaction between site and Models
- Models: Direct database interaction and functionality

* Public view: Anyone can access, can see sign in
* Student view: Can request to reserve a room, can logout, user account (change info)
* Admin view: See dashboard (graphs, tables, cards)

# WebApp conditions:

- Admin cannot change any user data
- New Users cannot apply for admin

# April 1: Video Presentation

- Zip the source code
- Compile Database schema inside zip file
- send DB CSV file for easier Database population on Sir's end

# To-Do

- Fix font size, and family (make it universal)
- Update color names properly and apply them
- Once functionality completed, sync with Javascript display

* Why store your phone numbers with a varchar with a 15 char limit? cause that's the E.164 standard
  https://dev.to/jkprod/best-way-to-store-phone-numbers-in-your-app-1j1o
