document.addEventListener('DOMContentLoaded', function() {
     const tabsHeaders = document.querySelectorAll('[data-tab]')
     const contentBoxs = document.querySelectorAll('[data-tab-content]')

     tabsHeaders.forEach((tabHeader) => {
         tabHeader.addEventListener('click', function (e) {
             // console.log(this.dataset.tab)
             console.log(e.target);

             const contentBox = document.querySelector('#' + this.dataset.tab)

             contentBoxs.forEach(item => {
                 item.classList.add('hidden')
             })

             tabsHeaders.forEach(item => {
                item.classList.remove('btn-primary')
                item.classList.add('btn-outline-secondary')
             })

             e.target.classList.remove('btn-outline-secondary')
             e.target.classList.add('btn-primary')
             contentBox.classList.remove('hidden')
         })
     })

}, false);



