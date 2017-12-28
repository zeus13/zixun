export function test (time) {
  return 'test'
}

export function fetchArray (key) {
  return window.localStorage.getItem(key) ? JSON.parse(window.localStorage.getItem(key)) : []
}
export function saveArray (key, value) {
  window.localStorage.setItem(key, JSON.stringify(value))
}
export function clearArray () {
  window.localStorage.clear()
}
export function removeArray (key) {
  window.localStorage.removeItem(key)
}
export function isEmpty (value) {
  return value === '' || value === undefined || value === null || (Array.isArray(value) && value.length === 0) || (Object.prototype.isPrototypeOf(value) && Object.keys(value).length === 0)
}

export function reverse (value) {
  value = parseFloat(value)
  return Math.abs(value.toFixed(2))
}

export function ages (strBirthday) { // 计算年龄
  var returnAge
  var strBirthdayArr = strBirthday.split('-')
  var birthYear = strBirthdayArr[0]
  var birthMonth = strBirthdayArr[1]
  var birthDay = strBirthdayArr[2]
  var d = new Date()
  var nowYear = d.getFullYear()
  var nowMonth = d.getMonth() + 1
  var nowDay = d.getDate()
  if (nowYear === birthYear || strBirthday === '') {
    returnAge = 0 // 同年则为0岁
  } else {
    var ageDiff = nowYear - birthYear // 年之差
    if (ageDiff > 0) {
      if (nowMonth === birthMonth) {
        var dayDiff = nowDay - birthDay // 日之差
        if (dayDiff < 0) {
          returnAge = ageDiff - 1
        } else {
          returnAge = ageDiff
        }
      } else {
        var monthDiff = nowMonth - birthMonth // 月之差
        if (monthDiff < 0) {
          returnAge = ageDiff - 1
        } else {
          returnAge = ageDiff
        }
      }
    } else {
      returnAge = 0 // 返回-1表示出生日期输入错误晚于今天
    }
  }
  return returnAge
}

export function getBeautyTime (publishTime) { // 优化时间显示
  var timeNow = parseInt(new Date().getTime() / 1000)
  var d = timeNow - publishTime
  var days = parseInt(d / 86400)
  // var hours = parseInt(d / 3600)
  // var minutes = parseInt(d / 60)
  // var senconds = parseInt(d)
  if (days > 1) {
    return getStamp(publishTime)
  } else {
    return getStamp(publishTime, 'hms')
  }
}

// export function getBeautyTime (publishTime) { // 优化时间显示
//   var timeNow = parseInt(new Date().getTime() / 1000)
//   var d = timeNow - publishTime
//   var days = parseInt(d / 86400)
//   var hours = parseInt(d / 3600)
//   var minutes = parseInt(d / 60)
//   var senconds = parseInt(d)
//   if (days > 1) {
//     return days + '天前'
//   } else if (days <= 0 && hours > 0) {
//     return hours + '小时前'
//   } else if (hours <= 0 && minutes > 1) {
//     return minutes + '分钟前'
//   } else if (minutes <= 1 && senconds >= 0) {
//     return '刚刚'
//   } else {
//     return getStamp(publishTime)
//   }
// }

export function add0 (m) { // 保留年月日时分秒中的0
  return m < 10 ? '0' + m : m
}

export function getStamp (val, type = null, is0 = true) { // 获取指定的日期格式
  if (val === undefined) {
    return '&nbsp;'
  }
  if (val === 0 && is0) {
    return '&nbsp;'
  }
  var date = new Date(val * 1000)
  var Y = date.getFullYear()
  var M = (date.getMonth() + 1 < 10 ? '0' + (date.getMonth() + 1) : date.getMonth() + 1)
  var D = add0(date.getDate())
  var h = add0(date.getHours())
  var m = add0(date.getMinutes())
  var s = add0(date.getSeconds())
  var w = date.getDay()
  if (type === 'hm') { // 时分
    return h + ':' + m
  } else if (type === 'hms') { // 时分秒
    return h + m + s
  } else if (type === 'ymdhms') { // 年月日时分秒
    return Y + '-' + M + '-' + D + ' ' + h + ':' + m + ':' + s
  } else if (type === 'mdhm') { // 月日时分
    return M + '-' + D + ' ' + h + ':' + m
  } else if (type === 'md1') { // 月日1
    return M + '-' + D
  } else if (type === 'md2') { // 月日2
    return M + '.' + D
  } else if (type === 'hm') { // 时分
    return h + ':' + m
  } else if (type === 'week') {
    var week = ''
    switch (w) {
      case 0:
        week = '星期日'
        break
      case 1:
        week = '星期一'
        break
      case 2:
        week = '星期二'
        break
      case 3:
        week = '星期三'
        break
      case 4:
        week = '星期四'
        break
      case 5:
        week = '星期五'
        break
      case 6:
        week = '星期六'
        break
    }
    return week
  } else if (type === 'ymd') {
    return Y + M + D
  } else if (type === 'ms') {
    return m + ':' + s
  } else {
    return Y + M + D + h + m + s
  }
}

export function timeStamp2String (publishTime) { // 时间戳转成str日期
  // var dMinutes, dHours, dDays
  // var timeNow = parseInt(new Date().getTime() / 1000)
  // var d
  // d = timeNow - publishTime
  // dDays = parseInt(d / 86400)
  // dHours = parseInt(d / 3600)
  // dMinutes = parseInt(d / 60)
  // if (dDays > 0 && dDays < 8) {
  //   return dDays + '天前'
  // } else if (dDays <= 0 && dHours > 0) {
  //   return dHours + '小时前'
  // } else if (dHours <= 0 && dMinutes > 0) {
  //   return dMinutes + '分钟前'
  // } else if (d >= 0 && dDays < 8) {
  //   return '刚刚'
  // } else {
  //   var s = new Date(publishTime * 1000)
  //   return (s.getMonth() + 1) + '月' + s.getDate() + '日'
  // }
  var timeNow = parseInt(new Date().getTime() / 1000)
  var d = timeNow - publishTime
  var dDays = parseInt(d / 86400)
  if (dDays >= 0 && dDays < 1) {
    return '今天'
  } else if (dDays >= 1 && dDays < 2) {
    return '昨天'
  } else {
    return dDays + '天前'
  }
}

export function areainfo () {
  var areaobj = [
    {
      'name': '广西区',
      'cityList': [
        {
          'name': '南宁市',
          'areaList': ['兴宁区', '青秀区', '江南区', '西乡塘区', '邕宁区']
        }
      ]
    }
  ]
  return areaobj
}

export function wxshare (wx, obj) {
  var title = '度研美学美业商城上线了！'
  var desc = '度研美学美业商城上线了！'
  var link = 'http://aimaspa.afxeon.net/app/goodsIndex'
  var imgUrl = 'http://aimaspa.afxeon.net/headimg.jpg?v=1'
  if (!isEmpty(obj)) {
    title = obj.title
    desc = obj.title
    link = obj.title
    imgUrl = obj.title
  }
  wx.ready(function () {
    wx.hideAllNonBaseMenuItem()
    wx.showMenuItems({
      menuList: [
        'menuItem:share:appMessage',
        'menuItem:share:timeline',
        'menuItem:share:qq'
      ] // 要显示的菜单项，所有menu项见附录3
    })
    wx.onMenuShareQQ({
      title: title,
      desc: desc,
      link: link,
      imgUrl: imgUrl,
      success: function (res) {
      },
      cancel: function (res) {
      }
    })
    wx.onMenuShareAppMessage({
      title: title,
      desc: desc,
      link: link,
      imgUrl: imgUrl,
      success: function (res) {
      },
      cancel: function (res) {
      }
    })
    wx.onMenuShareTimeline({
      title: title,
      desc: desc,
      link: link,
      imgUrl: imgUrl,
      success: function (res) {
      },
      cancel: function (res) {
      }
    })
  })
}
