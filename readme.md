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
