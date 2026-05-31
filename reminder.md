# Industry-standard file-structure:

- Views: What the user sees
- Scripts: Frontend manager & functionality + bridge data to the controller
- Controller: Passively updates the front/backend by interacting with management/bl (who knows the user may want to add and delete at the same time)
- Management/Business Logic: Commands the data interaction between site and Models
- Models: Direct database interaction and functionality

* Public view: Anyone can access, can see sign in
* Student view: Can request to reserve a room, can logout, user account (change info)
* Admin view: See dashboard (graphs, tables, cards), can see view homepage, can logout

## Priority

- Footers [✅]
- Sweet alert [✅]
- Email formatted properly [✅]
- Dynamic Cards actually dynamic (not just dynamic data) [✅]
- Password validation, allowing or disallowing user inputs, show user the type requirements, confirm password twice [✅]
- Update logic to prevent schedule duplicates [✅]
- Update logic to prevent user duplicates [✅]
- Implement user roles. Every registration is a non-privileged user, assign session when logging in. User Controller handles setting the session variables [✅]

- Fix navbar implementation
- Sidebar can appear and clear and update color and room name, but not show next 3 schedules
- Make root path a constant for both JS and PHP

## Inessential

- Fix font size, and family (make it universal)
- Fix CSS grid layout just optimize
- Update notification to inform admin if there's schedule conflicts
- Chart count doesn't count closed rooms as part of a working hour and therefore should reduce the "free time & room" count
- Implement routing & SPA
- Optimize everything for performance, robustness, and remove redundance

* Why store your phone numbers with a varchar with a 15 char limit? cause that's the E.164 standard
  https://dev.to/jkprod/best-way-to-store-phone-numbers-in-your-app-1j1o

* Copied email from Entry #6
  https://reallygooddesigns.com/free-responsive-html-email-templates/