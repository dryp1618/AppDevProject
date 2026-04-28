# Industry-standard file-structure:

- Views: What the user sees
- Scripts: Frontend manager & functionality + bridge data to the controller
- Controller: Passively updates the front/backend by interacting with management/bl (who knows the user may want to add and delete at the same time)
- Management/Business Logic: Commands the data interaction between site and Models
- Models: Direct database interaction and functionality

* Public view: Anyone can access, can see sign in
* Student view: Can request to reserve a room, can logout, user account (change info)
* Admin view: See dashboard (graphs, tables, cards), can see view homepage, can logout

# Date notes:

- The current schedule only recorded right now is synced to 2ITA SY 2025-2026 for a smaller, manageable data set.

# To-Do

## Priority

- Form validation
- Admin can disable a room
- Once functionality completed, sync with Javascript display
- Dashboard cards
- Charts
- Email functionality

## Inessential

- Sweet alert
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

## Github lesson notes:

- If it is collaborative, make one email as the Repo Owner and share the credentials instead
- Visibility
  - Public: Anyone can view, download, comment on your code
  - Private: Only stays within the account
- gitignore: hides or does not upload certain files or folders
- In company, there's a separate team that only requests the repo

- dot(.) means all files
- Commands:
  - git init: initializes the git
  - git add
  - git commit -m "$message$": queues the changes to be uploaded with a message
  - git push: uploading the code to the repo
  - git switch -c $branch_name$ :create a new branch
    - git push -u origin new-branch: pushes a new branch
