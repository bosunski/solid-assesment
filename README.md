# Goal:
Refactor the LanguageBatch Class to look less disastrous!

The solution will be evaluated based on the following goals:
* Keep the original functionality(The `src/run.php` file must run successfully and produce expected results).
* Increase the inner code quality with `SOLID Principles`
* Increase test coverage with unit tests (If you can).

# Set up / Submission
* Fork this Repository to your account.
* Clone this repository from the forked version on your account.
* Refactor the code on a branch.
* When done, send PR to this repository (master branch) for reviews 

# Rules:
* Commit after each coding step, when the system is in working condition.
* The interface of the LanguageBatchBo can't be changed (the `src/run.php` should remain the same), but (of course) it's content can change and it can be split into new classes.
* The `ApiCall`, and `Config` classes are mock/simplified versions of the original dependencies, they can not be changed.
* The error message of the exceptions can be simplified.
* The console output of the script doesn't have to be the same as in the original version.
* Use PHPUnit as testing framework if You want to write tests.
* Inline comments are not necessary.
