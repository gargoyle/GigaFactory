# GigaFactory

GigaFactory is a simple container which allows you to register multiple factory 
classes and provides a single place you can call for creating your objects.

The GigaFactory will scan all the registered factories to for one that can create
the required object and invoke a method on that factory determined by a given name
resolver.

## Use Case

While working on a framework for a Command Query Responsibility Separation (CQRS) and
Event Source (ES) based system, I wanted a single entry point where I could create
the required Command or Query object from only a class name and a `$data` array of 
parameters.

## Example

TBC

