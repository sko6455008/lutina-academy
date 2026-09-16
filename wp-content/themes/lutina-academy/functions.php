<?php
function lutina_academy_scripts() {
    // Enqueue main stylesheet
    wp_enqueue_style( 'lutina-style', get_stylesheet_uri() );

    // Enqueue main script
    wp_enqueue_script( 'lutina-main', get_template_directory_uri() . '/main.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'lutina_academy_scripts' );

// カスタム投稿タイプ: Q&A（タイトル=質問、本文=回答。並び順は「ページ属性 > 順序」で管理）
function lutina_academy_register_qa_post_type() {
    register_post_type( 'qa', array(
        'label'  => 'Q&A',
        'labels' => array(
            'name'          => 'Q&A',
            'singular_name' => 'Q&A',
            'add_new'       => '新規追加',
            'add_new_item'  => '新規Q&Aを追加',
            'edit_item'     => 'Q&Aを編集',
            'menu_name'     => 'Q&A',
        ),
        'public'    => false,
        'show_ui'   => true,
        'menu_icon' => 'dashicons-editor-help',
        'supports'  => array( 'title', 'editor', 'page-attributes' ),
    ) );
}
add_action( 'init', 'lutina_academy_register_qa_post_type' );

// 旧ハードコードのQ&A 8項目を初回のみ投稿データとして登録する（登録済みなら何もしない）
function lutina_academy_seed_qa_posts() {
    if ( get_option( 'lutina_academy_qa_seeded' ) ) {
        return;
    }

    $faqs = array(
        array( 'q' => '占いの経験が全くない初心者でも大丈夫ですか？', 'a' => 'はい、当アカデミーの受講生の約8割が完全未経験からのスタートです。基礎から丁寧に指導しますのでご安心ください。' ),
        array( 'q' => '働きながら受講することは可能ですか？', 'a' => 'もちろんです。オンライン講座は24時間視聴可能で、対面講座も土日や夜間に開催しています。ライフスタイルに合わせて学べます。' ),
        array( 'q' => '卒業後に仕事の紹介はありますか？', 'a' => 'はい、卒業後の状況や適性に応じて、提携先の占いの館にご案内することがあります。また、独立開業のためのマーケティング講座も実施しています。' ),
        array( 'q' => '受講料の分割払いは可能ですか？', 'a' => 'はい、最大24回までの分割払いに対応しております。クレジットカードや教育ローンのご利用も可能です。' ),
        array( 'q' => 'オンライン授業と対面授業の違いは何ですか？', 'a' => 'カリキュラム内容は同一です。対面は講師から直接手技を学べるメリットがあり、オンラインは場所を選ばず繰り返し復習できるメリットがあります。' ),
        array( 'q' => '年齢制限はありますか？', 'a' => 'いいえ、年齢制限はございません。20代から70代まで幅広い年齢層の方が学ばれています。' ),
        array( 'q' => '途中でコースを変更することはできますか？', 'a' => '受講開始から1ヶ月以内であれば、コースの変更や追加が可能です。事務局までご相談ください。' ),
        array( 'q' => '霊感がないと占い師にはなれませんか？', 'a' => 'いいえ。タロットや占星術は「命・卜・相」という学問に基づいた技術ですので、霊感は必要ありません。正しい知識と技術で誰でも習得可能です。' ),
    );

    foreach ( $faqs as $i => $faq ) {
        wp_insert_post( array(
            'post_type'    => 'qa',
            'post_status'  => 'publish',
            'post_title'   => $faq['q'],
            'post_content' => $faq['a'],
            'menu_order'   => $i + 1,
        ) );
    }

    update_option( 'lutina_academy_qa_seeded', 1 );
}
add_action( 'init', 'lutina_academy_seed_qa_posts', 20 );

