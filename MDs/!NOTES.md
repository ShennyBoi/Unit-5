# Unit5

<h1>SEAN UNIT 5 PROJECT</h1>

<h2>Notes for Sean:</h2>

### How to improve Website

- align register boxes
- blur register background

### General Notes

- link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"

- https://developers.cloudflare.com/pages/how-to/deploy-a-wordpress-site/#deploy-a-static-wordpress-site

- read https://www.w3schools.com/css/css_navbar_vertical.asp for NavBar
- for general nav bar: PHP include_once "nav.php" ?

- https://www.w3schools.com/php/php_sessions.asp

- read https://css-tricks.com/snippets/css/a-guide-to-flexbox/ for flexboxes
- read https://www.sitepoint.com/understanding-and-using-rem-units-in-css/ for rems
- use poppins font

- "< link >" tag is for importing css style file
- anything in a php tag gets run on page load, even in an "onclick()"

## GIT COMMANDS

- GIT ADD .
- GIT COMMIT -M "MESSAGE"
- GIT PUSH ORIGIN MASTER

  ### File path referencing:

- ./ = current
- ../ = parent
- ../../ = grand?parent

## Standards:

### Database Standards:

- Key names should be in format [TableName]-[PK/FK]-[FieldName] (Or something along those lines)
- Unique keys are any primary keys which are NOT Compounded
- Indexes should be used for fields often used in "ORDER BY..." or "WHERE..." queries
- To add foreign key constraints:
  - `ALTER TABLE <'table-name'>`
  - `ADD CONSTRAINT tablename_FK_FieldID FOREIGN KEY (<fieldID>)`
  - `REFERENCES <table-name>(<fieldID>)`
- To add compound primary key constraints:
  - `ALTER TABLE table-name`
  - `ADD CONSTRAINT tablename_PK_FieldID`
  - `PRIMARY KEY (<field1>, <field2>)`

### CSS files system:

- all.css is for all php files
- each specifically named css file is for specific php files

<h2>Errors:</h2>

### Error with session variables:

- session start at the start of every page with any ref to session

### Page Loading error:

- unclosed PHP tag
- page not created
- / wrong path

<h2>Shortcuts:</h2>

- ### VSCode

  - CTRL + H -- Find and replace
    - then ALT + L -- F&R In selection
  - CTRL + SHIFT + H -- find & replace in whole project
  - F2 -- Rename File
  - CTRL + SHIFT + ' -- New Terminal

- ### Chrome
  - F12 -- Developer view

<h2>CSS:</h2>

### Justify Content

Justify-content determines how remaining space in the container will be<br>
distributed around the flex elements if there is any remaining space in<br>
the container main axis.

- <h4>Positional alignment:</h4>

  - justify-content: center -- Pack items around the center
  - justify-content: start -- Pack items from the start
  - justify-content: end -- Pack items from the end

  - justify-content: flex-start -- Pack flex items from the start
  - justify-content: flex-end -- Pack flex items from the end
  - justify-content: left -- Pack items from the left
  - justify-content: right -- Pack items from the right

- <h4>Baseline alignment</h4>

  - justify-content does not take baseline values

- <h4>Normal alignment</h4>

  - justify-content: normal

- <h4>Distributed alignment</h4>

  - justify-content: space-between -- Distribute items evenly.<br>
    The first item is flush with the start, the last is flush with the end
  - justify-content: space-around -- Distribute items evenly.<br>
    Items have a half-size spaceon either end
  - justify-content: space-evenly -- Distribute items evenly.<br>
    Items have equal space around them
  - justify-content: stretch -- Distribute items evenly.<br>
    Stretch 'auto'-sized items to fit the container

- <h4>Overflow alignment</h4>

  - justify-content: safe center;
  - justify-content: unsafe center;

- <h4>Global values</h4>

  - justify-content: inherit;
  - justify-content: initial;
  - justify-content: unset;

### Display

display: < tag >;

- inline -- Displays an element as an inline element (like < span >). Any height and width properties will have no effect;
- block -- Displays an element as a block element (like < p >). It starts on a new line and takes up the whole width;
- contents -- Makes the container disappear making the child elements children of the element the next level up in the DOM;
- flex -- Displays an element as a block-level flex container;
- grid -- Displays an element as a block-level grid container;
- inline-block -- Displays an element as an inline-level block container;
- inline-flex -- Displays an element as an inline-level flex container;
- inline-grid -- Displays an element as an inline-level grid container;
- inline-table -- The element is displayed as an inline-level table;
- list-item -- Let the element behave like a < li > element;
- run-in -- Displays an element as either block or inline depending on context
- table -- Let the element behave like a < table > element;
- table-caption -- Let the element behave like a < caption > element;
- table-column-group -- Let the element behave like a < colgroup > element;
- table-header-group -- Let the element behave like a < thead > element;
- table-footer-group -- Let the element behave like a < tfoot > element;
- table-row-group -- Let the element behave like a < tbody > element;
- table-cell -- Let the element behave like a < td > element;
- table-column -- Let the element behave like a < col > element;
- table-row -- Let the element behave like a < tr > element;
- none -- The element is completely removed;
- initial -- Sets this property to its default value;
- inherit -- Inherits this property from its parent element;
