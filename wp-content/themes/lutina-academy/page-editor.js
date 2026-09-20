(function (wp, config) {
    'use strict';
    const el = wp.element.createElement;
    const { useState } = wp.element;
    const { PanelBody, TextControl, TextareaControl, Button, Notice } = wp.components;
    const { useBlockProps, MediaUpload, MediaUploadCheck, RichText } = wp.blockEditor;

    function PageEditor({ type, attributes, setAttributes }) {
        const schema = config.schemas[type];
        const fields = attributes.fields || {};
        const [search, setSearch] = useState('');
        const blockProps = useBlockProps({ className: 'lutina-page-editor' });
        const update = (key, value) => setAttributes({ fields: { ...fields, [key]: value } });
        const valueOf = field => typeof fields[field.key] === 'string' ? fields[field.key] : field.default;

        const control = field => {
            const value = valueOf(field);
            const props = { label: field.label, value, onChange: next => update(field.key, next) };
            if (field.type === 'image') {
                return el('div', { className: 'lutina-image-field', key: field.key },
                    el(TextControl, { ...props, type: 'url' }),
                    value && el('img', { src: value, alt: '', className: 'lutina-image-preview' }),
                    el(MediaUploadCheck, null, el(MediaUpload, {
                        allowedTypes: ['image'],
                        onSelect: media => update(field.key, media.url),
                        render: ({ open }) => el(Button, { variant: 'secondary', onClick: open }, '画像を選択・変更'),
                    }))
                );
            }
            if (field.type === 'rich') {
                return el('div', { className: 'lutina-rich-field', key: field.key },
                    el('div', { className: 'lutina-field-label' }, field.label),
                    el(RichText, {
                        tagName: 'div', value, onChange: next => update(field.key, next),
                        'aria-label': field.label, className: 'lutina-rich-input',
                        allowedFormats: ['core/bold', 'core/italic', 'core/link'],
                    })
                );
            }
            return el(field.type === 'textarea' ? TextareaControl : TextControl, {
                ...props, key: field.key, rows: 4,
                ...(field.type === 'url' || field.type === 'email' ? { type: field.type } : {}),
            });
        };

        return el('div', blockProps,
            el('div', { className: 'lutina-editor-intro' },
                el('p', { className: 'lutina-editor-eyebrow' }, 'ICA 池袋キャリアアカデミー'),
                el('h2', null, schema.title + 'の編集'),
                el('p', null, '変更したい項目を開いて編集し、画面右上の「保存」で反映します。プレビューで公開前の表示も確認できます。'),
                el('p', { className: 'lutina-editor-note' }, '配置・配色はそのままに、文章・画像・リンクを変更できます。変更履歴から以前の内容に戻すこともできます。')
            ),
            type === 'home' && el(TextControl, { label: '編集項目を検索', placeholder: '例：料金、講師、住所', value: search, onChange: setSearch }),
            ...Object.entries(schema.groups).map(([group, title], index) => {
                const visible = schema.fields.filter(field => field.group === group && (!search || (title + field.label + valueOf(field)).toLowerCase().includes(search.toLowerCase())));
                if (!visible.length) return null;
                return el(PanelBody, { title, initialOpen: type === 'legal' || index === 0, ...(search ? { opened: true } : {}), key: group + (search ? '-search' : '') },
                    ...visible.map(control),
                    group === 'faq' && el(Notice, { status: 'info', isDismissible: false }, '質問・回答は既存のQ&A管理画面と連動しています。', el('a', { href: config.faqUrl, target: '_blank', rel: 'noopener noreferrer' }, 'Q&Aを編集する'))
                );
            })
        );
    }

    ['home', 'legal'].forEach(type => wp.blocks.registerBlockType('lutina/' + type, {
        apiVersion: 3,
        title: config.schemas[type].title,
        icon: type === 'home' ? 'welcome-widgets-menus' : 'media-text',
        category: 'design',
        attributes: { fields: { type: 'object', default: {} } },
        supports: { html: false, multiple: false },
        edit: props => el(PageEditor, { ...props, type }),
        save: () => null,
    }));
})(window.wp, window.lutinaPageEditor);
