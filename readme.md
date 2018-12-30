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
| NF-1 | As a visitor, I should see a number fact when I visit the home page. | A number and associated fact are presented on the home page. |
| NF-2 | As a visitor, I should see a date fact when I visit the home page. | A date and associated fact are presented on the home page. |
| NF-3 | As a visitor, I want to see a fact for a number I enter. | The visitor can enter a number and a fact for that number is displayed. |
| NF-4 | As a visitor, I want to see a fact for a date I enter. | The visitor can enter a date and a fact for that date is displayed. |

That's it for our initial stories. While these may seem simple, there are a number of design decisions hiding in these stories.

Programmers tend to look for challenges and we must work hard to cultivate a disciplined approach to our work. The first order of business is not to jump into NF-1 and write lots of code to fetch facts from numbersapi.com. You should notice that NF-1 does not mentioned numberfacts.com at all, or even specify that a random number fact is displayed. The team crafted the story this way intentionally. Our first goal is to establish a functional baseline covered by tests which will allow us to build the features described in the stories.

