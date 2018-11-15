/**
 * Created by feng on 2016/8/9.
 */

$(function () {
    addForm.init();
});

var addForm = {
    init: function () {
        //初始化变量
        var addBtn = $('.js-addForm-btn');  //添加按钮
        var addCon = $('.js-addForm');  //容器



        //添加事件监听
        addBtn.on('click', this.addEle);
        addCon.on('click','.js-addForm-del',this.delEle);

    },
    addEle: function () {
        var addCon = $('.js-addForm');  //容器
        var addtmp = $('.js-template'); //模板
        //处理name自增
        var nameid = addCon.data('nameid');
        if (!nameid) {
            nameid = 1;
        } else {
            nameid++;
        }

        var formHtml = addtmp.html();

        addCon.append(formHtml);
        addCon.data('nameid', nameid);
    },
    delEle: function (e) {
        $(e.target).parent().remove();
    }
};