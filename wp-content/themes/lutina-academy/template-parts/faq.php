                        <?php
                        // Q&A投稿（管理画面のQ&Aメニューで登録・更新・削除。並び順は「順序」昇順）
                        $faq_posts = get_posts(array(
                            'post_type'      => 'qa',
                            'posts_per_page' => -1,
                            'orderby'        => array('menu_order' => 'ASC', 'date' => 'ASC'),
                        ));
                        $faqs = [];
                        foreach ($faq_posts as $faq_post) {
                            $faqs[] = [
                                'q' => esc_html($faq_post->post_title),
                                'a' => wpautop($faq_post->post_content),
                            ];
                        }
                        foreach ($faqs as $i => $faq) : ?>
                            <div class="animate-on-scroll border border-accent-100 rounded-2xl overflow-hidden bg-white shadow-sm">
                                <button class="faq-button w-full px-8 py-6 flex items-center justify-between text-left focus:outline-none hover:bg-mystic-950 transition-colors">
                                    <span class="text-base font-bold text-mystic-600">
                                        <?php echo $faq['q']; ?>
                                    </span>
                                    <span class="ml-4 flex-shrink-0 text-accent-400">
                                        <i data-lucide="plus" class="faq-icon w-5 h-5"></i>
                                    </span>
                                </button>
                                <div class="accordion-content">
                                    <div class="px-8 pb-8 text-gray-500 text-sm leading-relaxed font-mincho border-t border-gray-50 pt-6">
                                        <?php echo $faq['a']; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
