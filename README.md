# Simple Free Text Property Search


## Description

Free Text Search Engine for the Irish Estate Properties using the [Daft.ie API](http://api.daft.ie).

The Engine translates what the user are looking for and transforms the input string into a string requests and then will send that request to the Daft.ie API.

The script also offers the voice speech recognition thanks HTML5 & JavaScript speech-input.


In this script, I use:

* PSR0 to PSR4 coding standards
* Formatted/documented code
* DRY (Don't Repeat Yourself) principle
* OOP code (including PHP Interfaces & Traits (PHP 5.4 specification)
* *spl_autoload_register* (which is very useful with PHP namespaces)
* View/Controller pattern
* Singleton pattern (even if not necessary...)
* PHP alternative syntax for the template (which makes the visibility easier)
* Class member access on instantiation (PHP >= 5.4)
* Short Array syntax (PHP >= 5.4)
* Using SOAPClient


## Search Query Examples

* 2 or 3 bed to rent between 1000 and 2000
* 3 bedrooms to buy in Dublin
* 2 or 3 beds apartment to rent in Cork around 400 and 600 euro
* 4 bedroom house to let in Galway for 1000 around 900 and 14000 per month


## Specification

* Search Type (Rental/Sale)
* Price (Min-Max)
* Bedroom (Min-Max)
* Property Types (house, apartment, site)
* House Types (terraced, semi-detached, detached, end-of-terrace, townhouse)
* Retrieve Areas from the API
* Retrieve Counties from the API
* Each search term has its own Class and is getting back by the "Parser" class and included by *spl_autoload_register()* SPL function
* HTML5 **speech-input** search
* Displayed the property results thanks to Daft's API


## Other Coding Convention

In addition of using the **PSR** and **PHP Pear**, I use my own for the naming of the variables

Here are the variable prefixes:
* a = Array
* i = Integer
* f = Float, Double
* b = Boolean
* s = String
* o = Object
* m = Mixed
* r = Resource
* c = 1 Character (I used only sometime that, as char is not a PHP valid type)

Following the "*letter type* lower case, the variable name is in UpperCamelCase (e.g., $a**MyVariable**)


## Server Requirements of the Web App

*Application Server* PHP 5.4.0 or higher.

*PHP Extension* SOAPClient


## About Me

I'm **Pierre-Henry Soria**, IT developer and passionate about e-businesses and marketing.


## Where to contact me?

You can by email at **pierrehenrysoria [[AT]] gmail [[D0T]] com**


## License

The script is under [Creative Commons Attribution 3.0](http://creativecommons.org/licenses/by/3.0/) license or later; See the LICENSE.txt file.
