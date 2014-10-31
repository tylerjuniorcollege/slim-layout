# Slim Layout

This is a simple layout object for Slim Framework that overrides the default View Layout.

## Installing

In your composer.json file, make sure to require:

`"tylerjuniorcollege/slim-layout":"dev-master"`

## Using in your Application.

There are a couple of ways to utilize the layout for your application. The simplest way is to pass the object when you instaciate the main app class:

```php
$app = new \Slim\Slim(array(
  'view'           => new \TJC\ViewLayout(),
  'templates.path' => 'templates'
));
```

Make sure to set the layout using the following:

```php
$app->view->setLayout('layout.php');
```

The layout that you specify must be located in the main templates path.

In the page method, all you need to do is call the main render function. That will render the page with the layout.

Finally, in your layout file, to print the main content for the application, use the array index "content" where you want to place your content.

```php
echo $data['content'];
```

If you want to pass other, outside data to the layout, use the method `setLayoutData` to pass it to the data variable.

### Setting Layout Data
The `setLayoutData` method is only used to pass other items to the layout, outside of the scope of the page. You can pass a single array to be merged into the data array, or you can specify two arguments.

```php
$app->view->setLayoutData('user', new \App\User('someusername'));

// OR
$app->view->setLayoutData(array('user' => new \App\User('someusername')));
```

### Getting Layout Data
#### In Application
The class has a `getLayoutData` method for easy access of layout data in the application code. If you just want to access a certain array key in the layout data, then passing it as an argument for the method is the best way to get access to that.

```php
$app->view->getLayoutData(); // returns the full layout data array without the content.

$app->view->getLayoutData('user'); // Returns the 'user' array value.
```

#### In the Layout View
All layout data is passed to the main layout view using the default `$data` variable.

### Disable/Enable Layout Rendering
By Default, when using this view object, the Layout will be rendered if a layout is specified. If you want to disable the layout rendering for any reason, calling:

```php
$app->view->disableLayout()
```
Will disable the layout and let you render the page just like normal.

Additionally, if you disabled the layout previously and you need to enable the layout, using the method `enableLayout()` will let you re-enable the layout.

### Simple Javascript/Stylesheet data
Both the Javascript and Stylesheet types have methods for adding files and inline code to their respective arrays.

#### Appending Files
The `appendJavascriptFile` and `appendStylesheet` methods add the respective files to the end of the current array. 

#### Appending Inline Data
The `appendJavascript` and `appendStyle` methods add the respective code to the end of the current array.

#### Prepending Files
The `prependJavascriptFile` and `prependStylesheet` methods prepend the respective files to the beginning of the array.

#### Prepending Inline Data
The `prependJavascript` and `prependStyle` methods prepend the respective code to the beginning of the array.

#### Resetting Data

## LICENSE
The MIT License (MIT)

Copyright (c) 2014 Tyler Junior College

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

