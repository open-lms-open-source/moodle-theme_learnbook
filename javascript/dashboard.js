$( document ).ready(function() {
    // CSS hack for the LB Courses block to prevent squishing when timeline is clicked.
    var calIcon = $('.block_lb_courses .cal-icon');
    calIcon.click(function() {
        var courseList = $('.lb_courses_list .coursebox');
        if ($(this).hasClass('icon-selected')) {
            courseList.removeClass('col-xl-4').addClass('col-xl-3');
        } else {
            courseList.removeClass('col-xl-3').addClass('col-xl-4');
        }
    });
});