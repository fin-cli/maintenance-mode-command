fp-cli/maintenance-mode-command
===============================

Activates, deactivates or checks the status of the maintenance mode of a site.

[![Testing](https://github.com/fp-cli/maintenance-mode-command/actions/workflows/testing.yml/badge.svg)](https://github.com/fp-cli/maintenance-mode-command/actions/workflows/testing.yml)

Quick links: [Using](#using) | [Installing](#installing) | [Contributing](#contributing) | [Support](#support)

## Using

This package implements the following commands:

### fp maintenance-mode

Activates, deactivates or checks the status of the maintenance mode of a site.

~~~
fp maintenance-mode
~~~

**EXAMPLES**

    # Activate Maintenance mode.
    $ fp maintenance-mode activate
    Enabling Maintenance mode...
    Success: Activated Maintenance mode.

    # Deactivate Maintenance mode.
    $ fp maintenance-mode deactivate
    Disabling Maintenance mode...
    Success: Deactivated Maintenance mode.

    # Display Maintenance mode status.
    $ fp maintenance-mode status
    Maintenance mode is active.

    # Get Maintenance mode status for scripting purpose.
    $ fp maintenance-mode is-active
    $ echo $?
    1



### fp maintenance-mode activate

Activates maintenance mode.

~~~
fp maintenance-mode activate [--force]
~~~

**OPTIONS**

	[--force]
		Force maintenance mode activation operation.

**EXAMPLES**

    $ fp maintenance-mode activate
    Enabling Maintenance mode...
    Success: Activated Maintenance mode.



### fp maintenance-mode deactivate

Deactivates maintenance mode.

~~~
fp maintenance-mode deactivate 
~~~

**EXAMPLES**

    $ fp maintenance-mode deactivate
    Disabling Maintenance mode...
    Success: Deactivated Maintenance mode.



### fp maintenance-mode status

Displays maintenance mode status.

~~~
fp maintenance-mode status 
~~~

**EXAMPLES**

    $ fp maintenance-mode status
    Maintenance mode is active.



### fp maintenance-mode is-active

Detects maintenance mode status.

~~~
fp maintenance-mode is-active 
~~~

**EXAMPLES**

    $ fp maintenance-mode is-active
    $ echo $?
    1

## Installing

This package is included with FP-CLI itself, no additional installation necessary.

To install the latest version of this package over what's included in FP-CLI, run:

    fp package install git@github.com:fp-cli/maintenance-mode-command.git

## Contributing

We appreciate you taking the initiative to contribute to this project.

Contributing isn’t limited to just code. We encourage you to contribute in the way that best fits your abilities, by writing tutorials, giving a demo at your local meetup, helping other users with their support questions, or revising our documentation.

For a more thorough introduction, [check out FP-CLI's guide to contributing](https://make.finpress.org/cli/handbook/contributing/). This package follows those policy and guidelines.

### Reporting a bug

Think you’ve found a bug? We’d love for you to help us get it fixed.

Before you create a new issue, you should [search existing issues](https://github.com/fp-cli/maintenance-mode-command/issues?q=label%3Abug%20) to see if there’s an existing resolution to it, or if it’s already been fixed in a newer version.

Once you’ve done a bit of searching and discovered there isn’t an open or fixed issue for your bug, please [create a new issue](https://github.com/fp-cli/maintenance-mode-command/issues/new). Include as much detail as you can, and clear steps to reproduce if possible. For more guidance, [review our bug report documentation](https://make.finpress.org/cli/handbook/bug-reports/).

### Creating a pull request

Want to contribute a new feature? Please first [open a new issue](https://github.com/fp-cli/maintenance-mode-command/issues/new) to discuss whether the feature is a good fit for the project.

Once you've decided to commit the time to seeing your pull request through, [please follow our guidelines for creating a pull request](https://make.finpress.org/cli/handbook/pull-requests/) to make sure it's a pleasant experience. See "[Setting up](https://make.finpress.org/cli/handbook/pull-requests/#setting-up)" for details specific to working on this package locally.

## Support

GitHub issues aren't for general support questions, but there are other venues you can try: https://fp-cli.org/#support


*This README.md is generated dynamically from the project's codebase using `fp scaffold package-readme` ([doc](https://github.com/fp-cli/scaffold-package-command#fp-scaffold-package-readme)). To suggest changes, please submit a pull request against the corresponding part of the codebase.*
