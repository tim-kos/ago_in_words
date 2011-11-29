# Simple and lightweight timeAgoInWords functionality

Many frameworks offer this functionality in form of helpers, but they are either bloated, support too much you don't ever need or are just too slow.
Or all of this. I thought it would be nice to fix this. The result is this little project.

## Usage

Pick the class/module for your specific language and plug it into your code. From then on it's a similar procedure for all languages:

      // PHP
      $time = new Time();
      echo $time->agoInWords($created); // $created must be parseable by strtotime()

      // NODEJS
      var Time = require('../path/to/file');
      console.log(Time.agoInWords(date)); // date must be parseable by the Date class

## Outputs

The output depends on how far in the past your date was. Here are all cases:

  * 2 years ago
  * 7 months, 3 weeks ago
  * 1 week, 4 days ago
  * 1 day, 1 hour ago
  * 16 hours, 1 minute ago
  * 35 minutes ago
  * 1 minute ago
  * a few seconds ago


## Todo

  * Support Ruby
  * Support Python
  * Tell me what you need