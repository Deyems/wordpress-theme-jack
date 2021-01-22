import {block_icons} from '../icons/index';
import './editor.scss';

const { registerBlockType } = wp.blocks;
const { Button, Dashicon } = wp.components;
const { __ } = wp.i18n;
const { MediaUpload, 
    MediaUploadCheck } = wp.blockEditor;

registerBlockType( 'udemy/media-upload', {
    title:                              __( 'Image Media Upload', 'recipe' ),
    description:                        __( 'Upload Image Media Upload', 'recipe' ),
    category:                           'common',
    icon:                               block_icons.wapuu,
    attributes: {
        img_ID: {
            type: 'number'
        },
        img_URL: {
            type: 'string',
            source: 'attribute',
            attribute: 'src',
            selector: 'img'
        },
        img_alt: {
            type: 'string',
            source: 'attribute',
            attribute: 'alt',
            selector: 'img'
        }
        
    },
    edit: ( props ) => {
        const ALLOWED_MEDIA_TYPES = [ 'image' ];

        const select_img = (media) => {
            props.setAttributes({
                'img_ID': media.id,
                'img_URL': media.url,
                'img_alt': media.alt,
            });
        };
        
        const remove_img = (media) => {
            props.setAttributes({
                'img_ID': null,
                'img_URL': null,
                'img_alt': null,
            })
        }

        return (
            <div className={props.className}>
                {props.attributes.img_ID ? 
                    <div className="img-ctr">
                        <img src={props.attributes.img_URL}
                            alt={props.attributes.img_alt}
                        />
                        {props.isSelected ? 
                        <Button className="btn-remove" onClick={remove_img}>
                            <Dashicon icon="no" size="20" />
                        </Button> : 
                            null
                        }
                        

                    </div> : 
                (
                    <MediaUploadCheck>
                        <MediaUpload
                            onSelect={ select_img }
                            allowedTypes={ ALLOWED_MEDIA_TYPES }
                            value={ props.attributes.img_ID }
                            render={ ( { open } ) => (
                                <Button className="button button-large" onClick={ open }>
                                    {__('Open Media Library', 'recipe')}
                                </Button>
                            ) }
                        />
                    </MediaUploadCheck>
                )}
            </div>
        )},
    save: ( props ) => {
        return (
            <div>
                <img src={props.attributes.img_URL}
                    alt={props.attributes.img_alt}
                />
            </div>
        )
    }
});