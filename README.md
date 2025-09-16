fin-cli/maintenance-mode-command
===============================

Activates, deactivates or checks the status of the maintenance mode of a site.

[![Testing](https://github.com/fin-cli/maintenance-mode-command/actions/workflows/testing.yml/badge.svg)](https://github.com/fin-cli/maintenance-mode-command/actions/workflows/testing.yml)

Quick links: [Using](#using) | [Installing](#installing) | [Contributing](#contributing) | [Support](#support)

## Using

This package implements the following commands:

### fin maintenance-mode

Activates, deactivates or checks the status of the maintenance mode of a site.

~~~
fin maintenance-mode
~~~

**EXAMPLES**

    # Activate Maintenance mode.
    $ fin maintenance-mode activate
    Enabling Maintenance mode...
    Success: Activated Maintenance mode.

    # Deactivate Maintenance mode.
    $ fin maintenance-mode deactivate
    Disabling Maintenance mode...
    Success: Deactivated Maintenance mode.

    # Display Maintenance mode status.
    $ fin maintenance-mode status
    Maintenance mode is active.

    # Get Maintenance mode status for scripting purpose.
    $ fin maintenance-mode is-active
    $ echo $?
    1



### fin maintenance-mode activate

Activates maintenance mode.

~~~
fin maintenance-mode activate [--force]
~~~

**OPTIONS**

	[--force]
		Force maintenance mode activation operation.

**EXAMPLES**

    $ fin maintenance-mode activate
    Enabling Maintenance mode...
    Success: Activated Maintenance mode.



### fin maintenance-mode deactivate

Deactivates maintenance mode.

~~~
fin maintenance-mode deactivate 
~~~

**EXAMPLES**

    $ fin maintenance-mode deactivate
    Disabling Maintenance mode...
    Success: Deactivated Maintenance mode.



### fin maintenance-mode status

Displays maintenance mode status.

~~~
fin maintenance-mode status 
~~~

**EXAMPLES**

    $ fin maintenance-mode status
    Maintenance mode is active.



### fin maintenance-mode is-active

Detects maintenance mode status.

~~~
fin maintenance-mode is-active 
~~~

**EXAMPLES**

    $ fin maintenance-mode is-active
    $ echo $?
    1

## Installing

This package is included with FIN-CLI itself, no additional installation necessary.

To install the latest version of this package over what's included in FIN-CLI, run:

    fin package install git@github.com:fin-cli/maintenance-mode-command.git

## Contributing

We appreciate you taking the initiative to contribute to this project.

Contributing isn’t limited to just code. We encourage you to contribute in the way that best fits your abilities, by writing tutorials, giving a demo at your local meetup, helping other users with their support questions, or revising our documentation.

For a more thorough introduction, [check out FIN-CLI's guide to contributing](https://make.finpress.org/cli/handbook/contributing/). This package follows those policy and guidelines.

### Reporting a bug

Think you’ve found a bug? We’d love for you to help us get it fixed.

Before you create a new issue, you should [search existing issues](https://github.com/fin-cli/maintenance-mode-command/issues?q=label%3Abug%20) to see if there’s an existing resolution to it, or if it’s already been fixed in a newer version.

Once you’ve done a bit of searching and discovered there isn’t an open or fixed issue for your bug, please [create a new issue](https://github.com/fin-cli/maintenance-mode-command/issues/new). Include as much detail as you can, and clear steps to reproduce if possible. For more guidance, [review our bug report documentation](https://make.finpress.org/cli/handbook/bug-reports/).

### Creating a pull request

Want to contribute a new feature? Please first [open a new issue](https://github.com/fin-cli/maintenance-mode-command/issues/new) to discuss whether the feature is a good fit for the project.

Once you've decided to commit the time to seeing your pull request through, [please follow our guidelines for creating a pull request](https://make.finpress.org/cli/handbook/pull-requests/) to make sure it's a pleasant experience. See "[Setting up](https://make.finpress.org/cli/handbook/pull-requests/#setting-up)" for details specific to working on this package locally.

## Support

GitHub issues aren't for general support questions, but there are other venues you can try: https://fin-cli.org/#support


*This README.md is generated dynamically from the project's codebase using `fin scaffold package-readme` ([doc](https://github.com/fin-cli/scaffold-package-command#fin-scaffold-package-readme)). To suggest changes, please submit a pull request against the corresponding part of the codebase.*
