module.exports = {
  hasOne   : false,
  hasYear  : false,
  hasMonth : false,
  hasWeek  : false,
  hasDay   : false,

  YEAR     : 31536000,
  MONTH    : 2592000,
  WEEK     : 604800,
  DAY      : 86400,
  HOUR     : 3600,
  MINUTE   : 60,

  agoInWords: function(date, now) {
    this.rewind();

    if (!now) now = +new Date() / 1000;
    var then = +new Date(date) / 1000;

    var diff = now - then;

    var years = Math.floor(diff / this.YEAR);
    diff -= years * this.YEAR;

    var months = Math.floor(diff / this.MONTH);
    diff -= months * this.MONTH;

    var weeks = Math.floor(diff / this.WEEK);
    diff -= weeks * this.WEEK;

    var days = Math.floor(diff / this.DAY);
    diff -= days * this.DAY;

    var hours = Math.floor(diff / this.HOUR);
    diff -= hours * this.HOUR;

    var minutes = Math.floor(diff / this.MINUTE);
    diff -= minutes * this.MINUTE;

    var r = '';
    if (years > 0) {
      r += this.sep() + this.pluralize(years, 'year');
      this.hasYear = true;
    }

    if (months > 0) {
      r += this.sep() + this.pluralize(months, 'month');
      this.hasMonth = true;
    }

    if (weeks > 0 && !this.hasYear) {
      r += this.sep() + this.pluralize(weeks, 'week');
      this.hasWeek = true;
    }

    if (days > 0 && !this.hasYear && !this.hasMonth) {
      r += this.sep() + this.pluralize(days, 'day');
      this.hasDay = true;
    }

    if (hours > 0 && !this.hasYear && !this.hasMonth && !this.hasWeek) {
      r += this.sep() + this.pluralize(hours, 'hour');
    }

    if (minutes > 0 && !this.hasYear && !this.hasMonth && !this.hasDay && !this.hasWeek) {
      r += this.sep() + this.pluralize(minutes, 'minute');
    }

    if (this.hasOne) return r + ' ago';
    return 'a few seconds ago';
  },

  pluralize: function(count, single, many) {
    this.hasOne = true;

    if (!many) many = single + 's';
    return count  + ' ' + (count == 1 ? single : many);
  },

  sep: function() {
    return this.hasOne ? ', ' : '';
  },

  rewind: function() {
    this.hasOne   = false;
    this.hasYear  = false;
    this.hasMonth = false;
    this.hasWeek  = false;
    this.hasDay   = false;
  }
};