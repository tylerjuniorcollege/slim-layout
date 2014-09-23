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

In the page method, you can call `renderLayout()` instead of the normal `render()` method to pass the content to the layout and render everything in place.

Finally, in your layout file, to print the main content for the application, use the array index "content" where you want to place your content.

```php
echo $data['content'];
```

If you want to pass other, outside data to the layout, use the method `setLayoutData` to pass it to the data variable.

### setLayoutData
The `setLayoutData` method is only used to pass other items to the layout, outside of the scope of the page. You can pass a single array to be merged into the data array, or you can specify two arguments.

```php
$app->view->setLayoutData('user', new \App\User('someusername'));

// OR
$app->view->setLayoutData(array('user' => new \App\User('someusername')));
```

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

