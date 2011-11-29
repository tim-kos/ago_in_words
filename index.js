module.exports = {
  agoInWords: function(date, now) {
    if (!now) now = +new Date() / 1000;
    var then = +new Date(date) / 1000;

    var diff = now - then;

    var years = Math.floor(diff / 31536000);
    diff -= years * 31536000;

    var months = Math.floor(diff / 2592000);
    diff -= months * 2592000;

    var days = Math.floor(diff / 86400);
    diff -= days * 86400;

    var hours = Math.floor(diff / 3600);
    diff -= hours * 3600;

    var minutes = Math.floor(diff / 60);
    diff -= minutes * 60;

    var r = '';
    var hasOne = hasYear = hasMonth = hasDay = false;

    if (years > 0) {
      if (hasOne) r += ', ';
      r += this.pluralize(years, 'year');
      hasOne = true;
      hasYear = true;
    }

    if (months > 0) {
      if (hasOne) r += ', ';
      r += this.pluralize(months, 'month');
      hasOne = true;
      hasMonth = true;
    }

    if (!hasYear && days > 0) {
      if (hasOne) r += ', ';
      r += this.pluralize(days, 'day');
      hasOne = true;
      hasDay = true;
    }

    if (!hasYear && !hasMonth && hours > 0) {
      if (hasOne) r += ', ';
      r += this.pluralize(hours, 'hour');
      hasOne = true;
    }

    if (!hasYear && !hasMonth && !hasDay && minutes > 0) {
      if (hasOne) r += ', ';
      r += this.pluralize(minutes, 'minute');
      hasOne = true;
    }

    if (hasOne) return r + ' ago';
    return 'a few seconds ago';
  },

  pluralize: function(count, single, many) {
    if (!many) many = single + 's';
    return count  + ' ' + (count == 1 ? single : many);
  }
};