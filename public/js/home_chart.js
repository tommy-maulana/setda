$(function () {
    'use strict'
  
    var ticksStyle = {
      fontColor: '#495057',
      fontStyle: 'bold'
    }
    var mode      = 'index'
    var intersect = true
  
    var $tmsk = $('#tdk-msk')
    var tmsk  = new Chart($tmsk, {
      type   : 'bar',
      data   : {
        labels  : ['Izin', 'Sakit', 'Cuti', 'Dinas Luar'],
        datasets: [        
          {
            backgroundColor: '#ced4da',
            borderColor    : '#ced4da',
            data           : [1,2,3,4]//['{{$b->izin}}','{{$b->sakit}}','{{$b->cuti}}','{{$b->dl}}}}']
          },
          {
            backgroundColor: '#007bff',
            borderColor    : '#007bff',
            data           : [4,3,2,1]//['{{$a->izin}}','{{$a->sakit}}','{{$a->cuti}}','{{$a->dl}}}}']
          }
        ]
      },
      options: {
        maintainAspectRatio: false,
        tooltips           : {
          mode     : mode,
          intersect: intersect
        },
        hover              : {
          mode     : mode,
          intersect: intersect
        },
        legend             : {
          display: false
        },
        scales             : {
          yAxes: [{
            // display: false,
            gridLines: {
              display      : true,
              lineWidth    : '4px',
              color        : 'rgba(0, 0, 0, .2)',
              zeroLineColor: 'transparent'
            },
            ticks    : $.extend({
              beginAtZero: true,
              suggestedMax: 14,
              // Include a dollar sign in the ticks
              callback: function (value, index, values) {
                if (value >= 1000) {
                  value /= 1000
                  value += 'k'
                }
                return  value
              }}, ticksStyle)
          }],
          xAxes: [{
            display  : true,
            gridLines: {
              display: false
            },
            ticks    : ticksStyle
          }]
        }
      }
    })
    var $detmggu = $('#det-1-mggu')
    var detmggu  = new Chart($detmggu, {
      type   : 'bar',
      data   : {
        labels  : ['10-30', '31-60', '61-90', '>90'],
        datasets: [        
          {
            backgroundColor: '#ced4da',
            borderColor    : '#ced4da',
            data           : [10, 13, 5, 7]
          },
          {
            backgroundColor: '#007bff',
            borderColor    : '#007bff',
            data           : [2, 5, 7, 9]
          }
        ]
      },
      options: {
        maintainAspectRatio: false,
        tooltips           : {
          mode     : mode,
          intersect: intersect
        },
        hover              : {
          mode     : mode,
          intersect: intersect
        },
        legend             : {
          display: false
        },
        scales             : {
          yAxes: [{
            // display: false,
            gridLines: {
              display      : true,
              lineWidth    : '4px',
              color        : 'rgba(0, 0, 0, .2)',
              zeroLineColor: 'transparent'
            },
            ticks    : $.extend({
              beginAtZero: true,
              suggestedMax: 14,
              // Include a dollar sign in the ticks
              callback: function (value, index, values) {
                if (value >= 1000) {
                  value /= 1000
                  value += 'k'
                }
                return  value
              }
            }, ticksStyle)
          }],
          xAxes: [{
            display  : true,
            gridLines: {
              display: false
            },
            ticks    : ticksStyle
          }]
        }
      }
    })
    var $detbln = $('#det-1-bln')
    var detbln  = new Chart($detbln, {
      type   : 'bar',
      data   : {
        labels  : ['10-30', '31-60', '61-90', '>90'],
        datasets: [        
          {
            backgroundColor: '#ced4da',
            borderColor    : '#ced4da',
            data           : [10, 13, 5, 7]
          },
          {
            backgroundColor: '#007bff',
            borderColor    : '#007bff',
            data           : [2, 5, 7, 9]
          }
        ]
      },
      options: {
        maintainAspectRatio: false,
        tooltips           : {
          mode     : mode,
          intersect: intersect
        },
        hover              : {
          mode     : mode,
          intersect: intersect
        },
        legend             : {
          display: false
        },
        scales             : {
          yAxes: [{
            // display: false,
            gridLines: {
              display      : true,
              lineWidth    : '4px',
              color        : 'rgba(0, 0, 0, .2)',
              zeroLineColor: 'transparent'
            },
            ticks    : $.extend({
              beginAtZero: true,
  
              // Include a dollar sign in the ticks
              callback: function (value, index, values) {
                if (value >= 1000) {
                  value /= 1000
                  value += 'k'
                }
                return  value
              }
            }, ticksStyle)
          }],
          xAxes: [{
            display  : true,
            gridLines: {
              display: false
            },
            ticks    : ticksStyle
          }]
        }
      }
    })
  
    var $mggu = $('#terlambat-1-mggu')
    var mggu  = new Chart($mggu, {
      data   : {
        labels  : ['18th', '20th', '22nd', '24th', '26th', '28th', '30th'],
        datasets: [
          {
            type                : 'line',
            data                : [3, 2, 5, 3, 6, 7, 10],
            backgroundColor     : 'tansparent',
            borderColor         : '#ced4da',
            pointBorderColor    : '#ced4da',
            pointBackgroundColor: '#ced4da',
            fill                : false
            // pointHoverBackgroundColor: '#ced4da',
            // pointHoverBorderColor    : '#ced4da'
          },
          {
          type                : 'line',
          data                : [5, 3, 4, 5, 4, 2, 1],
          backgroundColor     : 'transparent',
          borderColor         : '#007bff',
          pointBorderColor    : '#007bff',
          pointBackgroundColor: '#007bff',
          fill                : false
          // pointHoverBackgroundColor: '#007bff',
          // pointHoverBorderColor    : '#007bff'
          }]
      },
      options: {
        maintainAspectRatio: false,
        tooltips           : {
          mode     : mode,
          intersect: intersect
        },
        hover              : {
          mode     : mode,
          intersect: intersect
        },
        legend             : {
          display: false
        },
        scales             : {
          yAxes: [{
            // display: false,
            gridLines: {
              display      : true,
              lineWidth    : '4px',
              color        : 'rgba(0, 0, 0, .2)',
              zeroLineColor: 'transparent'
            },
            ticks    : $.extend({
              beginAtZero : true,
              suggestedMax: 5
            }, ticksStyle)
          }],
          xAxes: [{
            display  : true,
            gridLines: {
              display: false
            },
            ticks    : ticksStyle
          }]
        }
      }
    })
    var $bln = $('#terlambat-3-bln')
    var bln  = new Chart($bln, {
      data   : {
        labels  : ['Jan', 'Feb', 'Mar'],
        datasets: [
          {
            type                : 'line',
            data                : [7, 5, 8],
            backgroundColor     : 'tansparent',
            borderColor         : '#ced4da',
            pointBorderColor    : '#ced4da',
            pointBackgroundColor: '#ced4da',
            fill                : false
            // pointHoverBackgroundColor: '#ced4da',
            // pointHoverBorderColor    : '#ced4da'
          },
          {
          type                : 'line',
          data                : [10, 5, 3],
          backgroundColor     : 'transparent',
          borderColor         : '#007bff',
          pointBorderColor    : '#007bff',
          pointBackgroundColor: '#007bff',
          fill                : false
          // pointHoverBackgroundColor: '#007bff',
          // pointHoverBorderColor    : '#007bff'
          }]
      },
      options: {
        maintainAspectRatio: false,
        tooltips           : {
          mode     : mode,
          intersect: intersect
        },
        hover              : {
          mode     : mode,
          intersect: intersect
        },
        legend             : {
          display: false
        },
        scales             : {
          yAxes: [{
            // display: false,
            gridLines: {
              display      : true,
              lineWidth    : '4px',
              color        : 'rgba(0, 0, 0, .2)',
              zeroLineColor: 'transparent'
            },
            ticks    : $.extend({
              beginAtZero : true,
              suggestedMax: 5
            }, ticksStyle)
          }],
          xAxes: [{
            display  : true,
            gridLines: {
              display: false
            },
            ticks    : ticksStyle
          }]
        }
      }
    })
  })
