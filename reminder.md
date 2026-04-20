# Industry-standard file-structure:

- Views: What the user sees
- Scripts: Frontend manager & functionality + bridge data to the controller
- Controller: Passively updates the front/backend by interacting with management/bl (who knows the user may want to add and delete at the same time)
- Management/Business Logic: Commands the data interaction between site and Models
- Models: Direct database interaction and functionality

* Public view: Anyone can access, can see sign in
* Student view: Can request to reserve a room, can logout, user account (change info)
* Admin view: See dashboard (graphs, tables, cards)

# To-Do

## Priority

- Form validation
- Dashboard cards
- Charts
- Once functionality completed, sync with Javascript display

## Inessential

- Fix font size, and family (make it universal)
- Update color names properly and apply them

* Why store your phone numbers with a varchar with a 15 char limit? cause that's the E.164 standard
  https://dev.to/jkprod/best-way-to-store-phone-numbers-in-your-app-1j1o

# Hashing

- Password hash = argon2id
- API encrypt = AES

# Lesson notes:

- Dashboard cards are dynamically generated
- Every user text input should have a maximum length (dbAllow-1) = maxlength
- JS can also disallow minimum and maximum characters
- JS validation always happens on the client-side
- Another JS RegEx to only allow numbers

- Important validations:

* Text input maximum length
* Do not allow future date selection
