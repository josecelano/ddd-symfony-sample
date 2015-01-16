# DDD symfony sample application

By [Jose Celano](http://josecelano.com/)

A symfony sample application using DDD.

The purpose: testing some DDD concepts using Symfony.

## Domain

- User can register

## Installation

Symfony standard installation.

## What I want to test?

### Command and Event Bus by [Matthias Noback](http://php-and-symfony.matthiasnoback.nl/)

- Store events (DDD-CQRS)
- Handle events asynchronously (for better performance)
- Log events (for debugging)
- Use message queue (ActiveMQ and RabbitMQ) to send messages between different application modules

### Security layer [Michiel Uithol](http://www.utwente.nl/ewi/trese/graduation_projects/2008/Uithol.pdf)

- Authorization, where: command, app service?

### Repositories

- Agnostic base repository (implementations with Doctrine, MongoDB, ...)
- Is possible to use doctrine with annotations and keep domain decoupled? I have seen some people store view instead of domain entity.

### Validation

- Where to put validation: command, domain service, repository?

## References

### Other DDD Symfony sample applications

[https://github.com/tyx/ddd-sample-symfony](https://github.com/tyx/ddd-sample-symfony)
[https://github.com/leopro/trip-planner](https://github.com/leopro/trip-planner)
[https://github.com/tyx/cqrs-php-sandbox](https://github.com/tyx/cqrs-php-sandbox)
[https://github.com/SimpleBus](https://github.com/SimpleBus)

### The best blogs I have found about DDD+Symfony

[http://nobacksoffice.nl](http://nobacksoffice.nl)
[http://verraes.net](http://verraes.net)
[http://williamdurand.fr](http://williamdurand.fr)

### Posts that has inspired me.

[http://www.whitewashing.de/2013/09/04/decoupling_from_symfony_security_and_fosuserbundle.html](http://www.whitewashing.de/2013/09/04/decoupling_from_symfony_security_and_fosuserbundle.html)
[http://www.whitewashing.de/2012/08/22/building_an_object_model__no_setters_allowed.html](http://www.whitewashing.de/2012/08/22/building_an_object_model__no_setters_allowed.html)

[http://verraes.net/2014/11/domain-events](http://verraes.net/2014/11/domain-events)
[http://verraes.net/2013/04/decoupling-symfony2-forms-from-entities](http://verraes.net/2013/04/decoupling-symfony2-forms-from-entities)

[http://williamdurand.fr/2013/12/16/enforcing-data-encapsulation-with-symfony-forms](http://williamdurand.fr/2013/12/16/enforcing-data-encapsulation-with-symfony-forms)

[http://php-and-symfony.matthiasnoback.nl/2015/01/a-wave-of-command-buses](http://php-and-symfony.matthiasnoback.nl/2015/01/a-wave-of-command-buses)
[http://php-and-symfony.matthiasnoback.nl/2015/01/responsibilities-of-the-command-bus](http://php-and-symfony.matthiasnoback.nl/2015/01/responsibilities-of-the-command-bus)
[http://php-and-symfony.matthiasnoback.nl/2015/01/from-commands-to-events](http://php-and-symfony.matthiasnoback.nl/2015/01/from-commands-to-events)
[http://php-and-symfony.matthiasnoback.nl/2015/01/collecting-events-and-the-events-aware-command-bus](http://php-and-symfony.matthiasnoback.nl/2015/01/collecting-events-and-the-events-aware-command-bus)