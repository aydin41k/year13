
# Occompare

## Task
Compare two selected occupations in terms of Skills using ONET data. 

The zipped bundle provides the bare-minimum Laravel and Vue bootstrapping for your convenience. The parser service has been implemented to return a list of core skills along with their importance value from ONET. You are expected to come up with a *matching algorithm* that shows the similarity between the two occupations selected, in percentage value. We estimate it will take around 2 hours to complete, give or take.

#### What will we assess?
- Your coding practices, standards, and architecture
- Performance optimization throughout the application
- The efficiency of the algorithm
- Front end skills and UX design
- Ingenuity

We DO NOT expect you to write unit tests.

#### How to submit?
Upload your work to a git repository and send us the link. We need to be able to download the repository.

#### What to expect after submission?
We appreciate the time you spend and we promise to get back to you with a review of your code as soon as we can. The review will outline what we liked and what we did not. You are NOT expected to make any further revisions to your code after the review.

*All occupations data are being parsed from ONET using occupation code e.g. https://www.onetonline.org/link/details/11-9199.01*

## Solution

### Backend
- Refactored existing code
  - Removed unnecessary code and files: Any code that is not being used at the moment and doesn't have a placeholder for an upcoming usage should be removed; it can always be restored from version control if needed
    - Unused routes
    - Unused controller files
  - Changed controller method name from `index` to `list`, to be more descriptive
- Moved logic from the controller to the service
  - The controller should only be responsible for handling the request and returning a response
  - The service should be responsible for handling the business logic
- ~~Invented~~ Implemented the comparison logic 
  - Coded two ways of comparing occupations, but kept this one (the other one in the version history):
    - Count how many skills carry similar importance in both occupations (similarity/proximity value defined in the service and could later be moved to the database)
    - Calculate the percentage of the similar skills

### Frontend
- Moved the assignee name ("Completed by...") to an `env` variable for re-usability (SaaS/open source approach)
- Disabled comparing the occupation with itself
- Re-designed the layout
- Installed the vue-charjs and chart.js packages, added a Chart.js chart to enhance the comparison
- Added a table with a full list of skills and their importance for each occupation
- Added links to the O*NET website for each occupation

### Assumptions and Decisions

**Upgrading the frameworks**

I enforced and used PHP 7.4, as was told in the specs; correspondingly, did not upgrade from Laravel 5.5. Also, used Node 12.22 and corresponding older versions of the packages (including NPM).
This was a conscious decision; upgrading a framework should not be taken lightly and should not go ahead before agreeing with the stakeholders. Different plugins, integrations or even the hardware may depend on
the older versions of the frameworks. Also, upgrading the framework may introduce new bugs and backward-incompatibility issues, which is clearly outside the scope of this assignment.

**Testing**

No automated front-end or back-end testing (unit, feature or integration testing) was done as per the requirements. Otherwise, I would not ship out code that is not thoroughly tested.

**Authentication**

Authentication/authorisation is not implemented as it is outside the scope of the assignment.

**Dynamic fetching of the occupation list**

I decided not to implement dynamic fetching of the occupation list from the ONET website, as it would not add much value to the assignment. And from the business viewpoint, the list of occupations is not something that changes often. They way I would resolve this is, for example, to set up a daily cron to fetch and save the list every midnight. Dynamic fething is excessive for this case.

**Fallback messages/Form reset**

Normally, before shipping out an application I make sure that the users are alerted with clear messages in case things don't go to the plan. However, I did not implement any explicit error expectation or user alerting with this application.

### Live Demo

The application is live at https://year13.salimov.site for demo purposes.