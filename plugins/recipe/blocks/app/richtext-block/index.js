import {block_icons} from '../icons/index';

const { registerBlockType } = wp.blocks;
const { __ } = wp.i18n;
const { RichText } = wp.blockEditor;;

registerBlockType( 'udemy/rich-text', {
    title:  __( 'Rich Text Example', 'recipe' ),
    description: __( 'Rich text example', 'recipe' ),
    keywords: [
        __('rich', 'recipe'),
        __('rich-text', 'recipe')
    ],
    category: 'common',
    icon: block_icons.wapuu,
    attributes: {
        message: {
            type: 'array',
            source: 'children',
            selector: '.message-ctr'
        }
    },
    edit: ( props ) => {
        return (
            <div className={ props.className }>
                <h3>Rich Text Example Block</h3>
                <RichText
                tagName="div"
                multiline="p"
                placeholder={ __('Add your content here', 'recipe') }
                onChange={(new_val) => {
                    props.setAttributes({message: new_val})
                }}
                value={props.attributes.message}
                />
            </div>
        );
    },
    save: ( props ) => {
        return (
            <div>
                <h3>Good job</h3>
                <div className="message-ctr">
                    {props.attributes.message}
                </div>
            </div>
        )
    }
});