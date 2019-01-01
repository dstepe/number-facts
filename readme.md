# NumberFacts

This projects provides a simple, yet functional reference for various concepts important to our development practices. We will use this project to explore:

* Test driven development
* OOP design principles and patterns
* Laravel framework features
* Build and deploy pipeline

The goal is to follow a typical development process starting with user stories describing features and acceptance criteria. The git project will be tagged at appropriate points as the application is built, allowing us to review the work done over time.

## The NumberFacts Application

Our product is a web based application which displays facts about numbers and dates. The primary source of this data will be the public Numbers API (http://numbersapi.com). A secondary source of information will be maintained locally. A visitor to our web site will first see a fact for a randomly selected number as well as the current date. The visitor may then enter a number or date to see additional facts.

## Our Starting Point

We will start with a fresh Laravel application directory. As a team member, you should have development environment which allows you to run tests with PHPUnit, run static analysis tools such as PHP CS Fixer and PHPStan, and access the running Laravel application with a web browser.

In addition to the overall product vision, the product owner has developed an initial list of user stories and prioritized them in our backlog. We are using the numbering convention NF-m.n for our stories where 'm' is the story number and 'n' is the sub-task number, if relevant. The initial stories are presented below.

| ID   | User Story | Acceptance Criteria |
| ---- | ---------- | ------------------- |
| NF-01 | As a visitor, I should see a number fact when I visit the home page. | A number and associated fact are presented on the home page. |
| NF-02 | As a visitor, I should see a date fact when I visit the home page. | A date and associated fact are presented on the home page. |
| NF-03 | As a visitor, I want to see a fact for a number I enter. | The visitor can enter a number and a fact for that number is displayed. |
| NF-04 | As a visitor, I want to see a fact for a date I enter. | The visitor can enter a date and a fact for that date is displayed. |

That's it for our initial stories. While these may seem simple, there are a number of design decisions hiding in these stories.

Programmers tend to look for challenges and we must work hard to cultivate a disciplined approach to our work. The first order of business is not to jump into NF-01 and write lots of code to fetch facts from numbersapi.com. You should notice that NF-01 does not mentioned numberfacts.com at all, or even specify that a random number fact is displayed. The team crafted the story this way intentionally. Our first goal is to establish a functional baseline covered by tests which will allow us to build the features described in the stories.

## Project Setup

Starting Tag 0.0.0

We already have a new Laravel application for our project. Our next step is to add our own build and deploy tools. This project is not intended to cover the details of those tools. We are adding:

* build.xml
* .gitlab-ci.yml

And updating:

* phpunit.xml

You can refer to the git history to see the specific changes.

You should also set up your own local environment so you can run the feature and unit tests provided with the default Laravel application. Remember, the goal is to establish a baseline with the tests passing and the application working.

Note that with no source code to actually analyze, the pipeline may fail at this time.

## The First User Story

Starting Tag 0.1.0

Now that we have a known good startig point, we will begin implementing the feature described in story NF-01, "As a visitor, I should see a number fact when I visit the home page." This seems simple and it's very tempting to do far more work than necessary. Remember the acceptance criteria is simply "A number and associated fact are presented on the home page." We very intentionally left out the words "random" and "from numberfacts.com" in keeping with the INVEST (https://www.agilealliance.org/glossary/invest) criteria. The primary value of this story will be a product the stakeholders can react to, not final feature set.

We can now create a feature test which will demonstrate this functionality and ensure we continue providing this feature as development progresses. We will create a new feature test for the default home route that looks for the number 42 and the associated math fact "5 is the number of platonic solids." We selected this from the numberfacts.com site for testing purposes. (Review tag 0.1.1 to see the test.)

As expected, the test fails because the expected text is not found. We will address that by hardcoding the number and fact into the view. Remember, the practice of TDD requires the minimal amount of work necessary to make the test pass. In this case, there is no requirement for more than hardcoding in the view. This obviously won't be the final solution, but we don't know more than that right now.

And just like that, our feature test passes and we have a potentially shippable product which can be shown to stakeholders. (Review tag 0.1.2 for details.)

## Our First Refactoring

Starting Tag 0.1.2

We can foresee problems with the current view implementation and decide to tackle that now. We have a single view which includes all markup and we want to create a base view to make managing changes easier. It's time to refactor. Remember that refactoring is not "this is not working correctly, so let's change it." Refactoring is the process of taking code covered by tests and making it better, using the tests to ensure it continues producing the correct results. Refactoring should not result in changes to existing tests.

Our refactoring results in base view and a much simpler view for the home page. We had to update the home route as well. The feature test for NF-01 continues to pass, though, which tells us our refactoring did not break anything. (Review tag 0.2.0 for details.)

## Discovering Domain Objects

Starting Tag 0.2.0

The hardcoded number and fact is useful for producing something for stakeholders for review, but it doesn't help the development team understand how the application will work. Our next step will be to drive the static values deeper into the framework, working our way toward Domain Objects. We will begin by creating a controller for the home route (tag 0.2.1) and moving the static data from the view into variables provided by the controller method (tag 0.2.2). We run the feature test after each step to ensure nothing is broken.

Success! We have moved the hard coded data from the view into a controller method without breaking the feature. In doing so, we discover that our first domain object will represent a NumberFact and contain a number and fact. (Ok, we probably knew that already, but you get the point.) Now we can create that class using unit tests.

Our first attempt does the minimum necessary to make our new class return our static sample data while passing unit tests (tag 0.2.3). This gets us started, but it doesn't make sense for the number and fact to be generated in the class, the class should be told what those are. We refactor the tests and then the implementation in the class to do this (tag 0.2.4).

The NumberFact domain object is good enough for now and we can incorporate it into our controller. The controller will need to create the object, which is less than ideal, but is acceptable as a small step forward. We'll deal with NumberFact creation later. Our goal now is to discover what domain objects our application will be working with. After updating the controller method, we run the feature test to ensure the NR-01 story feature still passes. (Review tag 0.2.5 for details.)

## Moving On

Starting Tag 0.2.5

The team agrees that NF-01 is complete and can be marked done. The acceptance criteria has been met, we have discovered the first domain object in the application and we have something to share with stakeholders. It's time to move on to NF-02, "As a visitor, I should see a date fact when I visit the home page." The acceptance criteria is similar to NF-01, "A date and associated fact are presented on the home page." We'll take the same approach of creating a feature test and making it pass with static data in the view. (Review tag 0.3.0 for details.)

As we start to move the static values from the view into the controller, we refactor to create a second NumberFact object to contain the date fact. Unfortunately, we discover that our implementation of NumberFact assumed an integer parameter for the number. While this made sense for our first use case, the need to represent a date complicates our object. Since we found this early, we can take the opportunity to rethink our design.

The team tries a couple of different designs but settles on using an interface to represent a NumberFact and individual concrete classes for NumberFactInteger and NumberFactDate. Since much of the implementation is common between the two, a PHP trait is used to encapsulate and share it. (Review tag 0.3.1 for details.) The team did discuss using an abstract NumberFact class, but foresaw problems when creational patterns were needed in the future. The interface follows OOP principles and facilities good type hinting in PHP.

## Recap

The team considers NF-02 to be done, and a quick review shows we have delivered a potentially shippable product which provides the highest value features. The stakeholders can react to that product, while the team has been able to establish the application framework and build pipeline. The implementation is still limited, but represents the least code necessary to deliver the features. We have feature and unit test coverage and have discovered the first domain object.

Even though we only delivered two user stories, these features should be deployed to production by this point. (The pipeline and deployment are out of scope for this project, but the within the capabilities of the organization to achieve.) Do not underestimate the value of these accomplishments. The team will delivery more value, faster by having the pipeline established and a foundation of simple, well tested code. Deferring either will lead to delays and risky changes.

## Feature Review

The stakeholders are happy with the product so far and the product owner adds more user stories to further clarify the desired features.

| ID   | User Story | Acceptance Criteria |
| ---- | ---------- | ------------------- |
| NF-05 | As a visitor, I should see a random number fact when I visit the home page. | A random number and associated fact are presented on the home page. |
| NF-06 | As a visitor, I should see a date fact for today when I visit the home page. | A date and associated fact for the current date are presented on the home page. |

These additions do not change the priority order, so work will proceed on NF-03.

## Getting Real Facts

NF-02 is a substantial feature, "As a visitor, I want to see a fact for a number I enter." The acceptance criteria has two parts, "The visitor can enter a number and a fact for that number is displayed." First, we must allow the visitor to enter a number. Second, we must display a fact for that number. We can break this into smaller sub-tasks:

* Add a number input to the home page
* Fetch a fact for the provided number
* Display the fact for the provided number

We clarify that the provided number and fact should replace the default, not appear in addition.

Notice that we do not consider what constitutes a valid number at this point. Our first priority is to make the feature work on the "happy path" with known, valid values. The product owner can prioritize a separate story for validation.

The number input and display of the resulting fact should be covered by feature tests, so we start there. We use a new set of static data to implement the feature in order to distinguish from the the first. We also take this opportunity to refactor the blades, creating a reusable partial in order to keep DRY. (Review tag 0.4.0 for details.)

At this point, our two controllers are responsible for creating NumberFact objects using hard-coded values. While this gets our tests passing and gives the stakeholders something to review, creating objects should be handled by something else. After some discussion, the team decides we need a NumberFactFinder class to assume this responsibility. The controllers will use this class to find a NumberFact for display through the views.

The smallest change possible is to move the NumberFact creation into appropriate methods of the NumberFactFinder class. We avoid any other changes until we know the new class is behaving correctly and all feature tests continue to pass. The FactFinder class starts off with all the same hard coded values and very limited facts, but achieves the goal of moving the creation responsiblity into an appropriate class. (Review tag 0.4.1 for details.)

Once the NumberFactFinder class is ready, we use Laravel's dependency injection to make it available to our two controllers and replace the creation of the NumberFacts with calls to the NumberFactFinder (tag 0.4.2). All feature tests continue to pass with no changes, which gives us high confidence that the existing features have not been impacted.

## Retreiving Fact Data

The creation of concrete NumberFact objects is nicely isolated in the NumberFactFinder, but that class needs to get facts from something more sustainable than a switch statement. Nothing else in the system should change. Let's say that again. Nothing else in the system should change. The NumberFact and NumberFactFinder classes have their single responsibilities which do not include actually optaining fact data. The NumberFactFinder will use another class to optain the data and construct the NumberFact objects.

What is that other class? There are a couple of patterns which may fit here. The team opts to implement a Repository. At this point, we should be looking forward. We know that fact data will need to come from the numberfacts.com REST API, but we don't want to rely on that API during our unit and feature testing. Our job is not to test the external API. We decide to create a Repository interface with a concrete implementation using YAML data files for now.

The team has a little more discussion before starting on the Repository. The NumberFactFinder will use the Repository to find facts. The team would like to use a fluent interface to make it easy to expand the capabilities. The Repository will return data which the NumberFactFinder will use to construct approprirate NumberFact objects. The returned data could be in the form of an array, but that would require constant maintainence and risk bugs. The team decides to create a Data Transfer Object to carry the data between the objects. The common API result fields from numberfacts.com will be used as a starting point.

Reviewing the numberfacts.com API, we find that number facts can be either math or trivia types. We've only been using math types for our development so far. This will have implications for our design, but we will deal with the upstream changes after the Repository is done.

The first task is to create the Repository interface, a concrete implemenation for YAML and the data transfer object. The Repository interface only needs two methods for now. (Review tag 0.4.2 for details.)

After the Repository is working, we can declare the interface as a dependency to the NumberFactFinder and wire the YAML backed implementation into the container in the AppServiceProvider. This requires providing a Repository implementation while testing the NumberFactFinder class and we opt to use a mock to prevent dependency on the YAML data. (Review tag 0.4.3 for details.)
 
 ## Using an External Service
 
Starting Tag 0.4.3
 
The YAML backed Repository helped us discover and isolate the fetching of actual number fact data. The next step is to implement a REST backed Repository and use the real numbefacts.com API. We will use the popular GuzzleHttp library to perform REST requests. We do not want to rely on the external service while testing, but GuzzleHttp provides some useful testing features for us to use. Our first attempt at the REST Repository seems to go well, though we're only using mock responses for now (tag 0.5.0).
 
We can wire the REST Respository into the application in the AppServiceProvider. We use an environment variable to determine when to use the YAML Repository (setting the variable in the phpunit.xml configuration) so our tests will continue working. The moment of truth comes when we try the web application. Disappointingly, we find that we neglected to set the Content-Type header on the requests, we are not getting back the expected JSON data. We add tests to ensure the header is set, implement the change and our app starts working. (Review tag 0.5.1 for details.)

The team steps back and contemplates how our development has progressed. Rather than jumping on what was expected to be the most challenging task first, that of interacting with the remote API, we started by building features based on static data. We drove that static data deeper into the application, discovering domain objects and interfaces as we went. When the time came to implement the interaction with the external API, we found it was trivial to accomplish and had no impact on the rest of our application. 

We observe a lot of redundancy and opportunity for improvement in the REST Repository class. Armed with tests, however, we are highly confident we can refactor that class without causing any issues. The refactoring is quick and results in a simpler class. We also remove a redundant unit test (love your tests like you love your code). (Review tag 0.5.2 for details.)

In our excitment at how well the REST implementation went, we almost forgot to connect the user input to the lookup. A quick change to the lookup controller, and a little navigation to help get around, and we finish NF-03 with a fully functional application. (Review tag 0.5.3 for details.)

## The Last Original Feature

Starting Tag 0.5.3

The last of the original user stories should be easy to complete now. NF-04 states taht "As a visitor, I want to see a fact for a date I enter." The acceptance criteria is "The visitor can enter a date and a fact for that date is displayed." This is very similar to NF-03 and the implementation should be straight forward.

Reviewing the necessary UI changes with the product owner leads to a realization that combining the number and date lookup is probably not ideal. The team splits the lookup functionality into number and date, ensuring that all feature tests continue to pass and support the functionality (tag 0.6.0).

Finishing the implementation of the date lookup was easy, but also exposed some other issues which were previously hidden. (Review tag 0.6.1 for details.)

## Wrapping up the First Feature Set

The stakeholders are very pleased with the features delivered so far. They have been able to test the application and work with the product owner to define new stories. The following additional stories have been added to the backlog:

| ID   | User Story | Acceptance Criteria |
| ---- | ---------- | ------------------- |
| NF-07 | As a visitor, I should be able to select the month and day of a date to lookup. | A pop list of months and a pop list of dates are provided to select the input values. |
| NF-08 | As a visitor, I should be not be able to submit an invalid number to lookup. | The number lookup form only allows valid integer values to be submitted. |
| NF-09 | As a visitor, I should be able to choose between math and trivia number facts when looking up a number. | A form control allows choosing between math and trivia types, with math being the default. |
| NF-10 | As a visitor, I should see the home page randomly choose between math and random number types. | The home page randomly chooses between math and trivia number fact types. |

You will notice that these stories are enhancements to existing features. Some, like using pop-ups for the month and day inputs, may seem obvious and you would be tempted to implement them during the original feature development. However, doing so would violate the principle of writing the least code to satisfy the requirement. You could argue that the pop-ups should just be part of the original feature, but that violates the INVEST approach to stories. By implementing the no frills basic functionality, we do the list work necessary to give stakeholders something to react to. Improving it comes later.

## Randomness

Starting Tag 0.6.1

The team is ready to move on to NF-05, "As a visitor, I should see a random number fact when I visit the home page." Randomness seems orthogonal to our strictly static test data and the team worries this feature will jeopardize the current test coverage. After discussing the issue, we decide that a random number class can be used to enable this feature. If that class is provided as a dependency, we can use a mock during testing to ensure we always get the expected value. A random number generator suitable for our purposes only takes a few minutes (tag 0.7.0).

We decide to implement the RandomNumber in the NumberFactFinder class. We considering having the controller find the random number, then use the NumberFactFinder as it does now, but that seems to put too much into the controller. The RandomNumber implementation is injected into the NumberFactFinder and used to get a suitable random number. We use Laravel's App::runningUnitTests() to add the correct RandonNumber implementation to the container at run time so our tests continue passing with a known "random" number for the home page. (See tag 0.7.1 for details.)
