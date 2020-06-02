/**
 * @license Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function (config) {
    // Define changes to default configuration here. For example:
    // config.language = 'fr';
    config.extraPlugins = "codesnippet";
    config.codeSnippet_theme = "monokai_sublime";
    config.height = 356;
    config.uiColor = "#66c2ff";
    config.toolbarGroups = [
        {
            name: "document",
            groups: ["mode", "document", "doctools"],
        },
        {
            name: "clipboard",
            groups: ["clipboard", "undo"],
        },
        {
            name: "editing",
            groups: ["find", "selection", "spellchecker", "editing"],
        },
        {
            name: "forms",
            groups: ["forms"],
        },
        "/",
        {
            name: "basicstyles",
            groups: ["basicstyles", "cleanup"],
        },
        {
            name: "paragraph",
            groups: ["list", "indent", "blocks", "align", "bidi", "paragraph"],
        },
        {
            name: "links",
            groups: ["links"],
        },
        {
            name: "insert",
            groups: ["insert"],
        },
        "/",
        {
            name: "styles",
            groups: ["styles"],
        },
        {
            name: "colors",
            groups: ["colors"],
        },
        {
            name: "tools",
            groups: ["tools"],
        },
        {
            name: "others",
            groups: ["others"],
        },
        {
            name: "about",
            groups: ["about"],
        },
    ];

    config.removeButtons =
        "Print,Save,NewPage,Preview,Templates,PasteText,PasteFromWord,Find,Replace,SelectAll,Scayt,Form,Checkbox,Radio,Select,Textarea,TextField,Button,HiddenField,ImageButton,Subscript,Superscript,CopyFormatting,RemoveFormat,Flash";
};
