import {block_icons} from "../icons/index";
import btn_icon from  "./icon";
import classnames from 'classnames';
import "./editor.scss";

const { registerBlockType } = wp.blocks;
const { __ } = wp.i18n;
const { BlockControls, InspectorControls } = wp.blockEditor;;
const { Toolbar, Button, Tooltip, 
        PanelBody, PanelRow, FormToggle } = wp.components;

registerBlockType('udemy/night-mode', {
    title: __('Night mode', 'recipe'),
    description: __('Making night and day mode', 'recipe'),
    category: 'common',
    keywords: [
        __('night', 'recipe'),
        __('mode switch-mode', 'recipe'),
        __('light-mode', 'recipe'),
    ],
    example: {
        attributes: {
            night_mode: 'dark OR light',
        },
    },
    icon: block_icons.wapuu,
    attributes: {
        night_mode: {
            type: 'boolean',
            default: false
        }
    },
    edit: (props) => {
        const toggle_night_mode = () => {
            props.setAttributes({night_mode: !props.attributes.night_mode})
        }
        return (
            [
                <InspectorControls>
                    <PanelBody title={ __ ('Night Mode here', 'recipe')}>
                        <PanelRow>
                            <label htmlFor="udemy-recipe-night-mode-toggle">
                                {__('Night mode', 'recipe')}
                            </label>
                            <FormToggle id="udemy-recipe-night-mode-toggle" 
                                        checked={ props.attributes.night_mode }
                                        onChange = { toggle_night_mode }
                            >
                            </FormToggle>
                        </PanelRow>
                    </PanelBody>
                </InspectorControls>,

                <div className={props.className}>
                    <BlockControls>
                        <Toolbar>
                            <Tooltip text={__('Night mode', 'recipe')}>
                                <Button className={ classnames(
                                    'components-icon-buton',
                                    'components-toolbar__control',
                                    { 'is-active': props.attributes.night_mode }
                                )}
                                onClick={ toggle_night_mode }>
                                    { btn_icon }
                                </Button>
                            </Tooltip>
                        </Toolbar>
                    </BlockControls>
                    <div className={ classnames(
                        'content-example',
                        {'night': props.attributes.night_mode}
                        )}>
                        An example of content with night mode
                    </div>
                </div>
            ]
        )
    },

    save: (props) => {
        return (
            <div>
                <div className={ classnames(
                    'content-example',
                    {'night': props.attributes.night_mode}
                    )}>
                    An example of content with night mode
                </div>
            </div>
        )
    }
})