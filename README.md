Wordpress Dummy Info
---------------------

## Configuration
- Provide a wp-local-config.php file for local development

## Project Structure

mbi-theme
|
-- *.php
-- assets
		|
		-- conf
				|
				-- scripts.json
		-- src
				|
				-- js
				-- styles
		-- build (generated)


## Styleguides SCSS
### scss selectors
- List @extend(s) First
- List "Regular" Styles Next
- List @include(s) Next
- Nested Selectors Last
- Maximum Nesting: Three Levels Deep !!!

### naming
- Variablize All Colors

### misc
- _shame.scss last
- do not commit .css files