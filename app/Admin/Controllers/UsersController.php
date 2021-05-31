<?php

namespace App\Admin\Controllers;

use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class UsersController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'User';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User());

        $grid->column('id', __('Id'));
        $grid->column('name', __('用户名'));
        $grid->column('email', __('邮箱'));
        // $grid->column('email_verified_at', __('激活时间'));
        // $grid->column('password', __('密码'));
        // $grid->column('remember_token', __('Remember token'));
        // $grid->column('created_at', __('创建日期'));
        // $grid->column('updated_at', __('更新日期'));
        $grid->column('avatar', __('头像'));
        $grid->column('introduction', __('简介'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        //用户详情页
        $show = new Show(User::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('用户名'));
        $show->field('email', __('邮箱'));
        $show->field('email_verified_at', __('激活时间'));
        // $show->field('password', __('密码'));
        // $show->field('remember_token', __('Remember token'));
        // $show->field('created_at', __('Created at'));
        // $show->field('updated_at', __('Updated at'));
        $show->field('avatar', __('头像'));
        $show->field('introduction', __('简介'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        //用户编辑页
        $form = new Form(new User());

        $form->text('name', __('用户名'))->rules('required|between:3,25');
        $form->email('email', __('邮箱'));
        // $form->datetime('email_verified_at', __('激活时间'))->default(date('Y-m-d H:i:s'));
        $form->password('password', __('密码'))->placeholder('输入 重置密码');
        // $form->text('remember_token', __('Remember token'));
        $form->image('avatar', __('头像'))->move('/uploads/images/avatars/')    ;
        $form->text('introduction', __('简介'));
        $form->saving(function (Form $form) {
            if ($form->password) {
                $form->password = bcrypt($form->password);
                }
        });

        return $form;
    }
}
