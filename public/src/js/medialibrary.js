$(function() {
        
        ZZ.medialibrary = (function() {

                var currentPath;

                var config = {
                        field: ZZ.config.medialibrary.field,
                        services: {
                                browse: '/medialibrary/browse',
                                fileDelete: '/medialibrary/file_delete',
                                filesUpload: '/medialibrary/upload',
                                folderCreate: '/medialibrary/folder_create',
                                folderDelete: '/medialibrary/folder_delete'
                        },
                        basepath: ZZ.config.medialibrary.config.basepath,
                        templatePath: 'packages/psimone/platform-core/tpl',
                        selectors: {
                                selectedClass: 'selected',
                                hiddenClass: 'hidden',
                                folderAttribute: 'folder',
                                pathAttribute: 'path',
                                
                                container: '#medialibrary',
                                fileUpload: '#fileupload',
                                item: '.resource',
                                newFolder: '#input-folder',
                                delete: '.act-delete',
                                cancel: '#btn-cancel',
                                confirm: '#btn-confirm',
                                createFolder: '#btn-create-folder',
                                progressBar: '#progress .progress-bar',
                                select: '#btn-select',
                                upload: '#btn-upload'
                        },
                        blockUI: {
                                css: { 
                                        border: 'none',
                                        'font-size': '14px',
                                        padding: '15px',
                                        backgroundColor: '#333',
                                        '-webkit-border-radius': '10px',
                                        '-moz-border-radius': '10px',
                                        opacity: .5,
                                        color: '#fff'
                                }
                        }
                };

                /**
                 * Init of the component
                 *
                 * @param {object} settings
                 */
                var init = function(settings)
                {
                        $.extend(config, settings);

                        setup();
                };

                /**
                 * Setup of the component
                 */
                var setup = function()
                {
                        bindDoubleClick();

                        bindClick();

                        bindButtons();
                        
                        bindActions();

                        browse().done(function(){
                                selectValue();
                                
                                uploadButton();
                        });
                };

                /**
                 * Call to the browse service
                 *
                 * @param {string} path
                 */
                var browse = function(path)
                {
                        var dfd = new jQuery.Deferred();
                        
                        var target;

                        if (typeof path === 'undefined')
                        {
                                target = config.basepath;
                        }
                        else
                        {
                                target = path;
                        }
                        
                        UI.block();

                        $.post(config.services.browse, {
                                field: ZZ.config.medialibrary.field,
                                path: target
                        }).done(function(data)
                        {
                                currentPath = target;
                                
                                render({ "resources": data }, target).done(function()
                                {
                                        truncate();
                                        
                                        UI.unblock();
                                        
                                        dfd.resolve(data);
                                });
                        });
                        
                        return dfd.promise();
                };

                /**
                 * Render the service data
                 *
                 * @param {object} data
                 * @param {string} path
                 */
                var render = function(data, path)
                {
                        var dfd = new jQuery.Deferred();
                        
                        loadTemplate('catalog.html').done(function(source)
                        {                                
                                var template = Handlebars.compile(source);

                                var html = template(data);

                                container().empty().append(html);

                                Holder.run();
                                
                                dfd.resolve();
                        });
                        
                        return dfd.promise();
                };

                /**
                 * Dispatch the open event (doubleClick) for the items
                 *
                 * @param {object} obj
                 */
                var handleDoubleClick = function(obj)
                {
                        var $item = $(obj);

                        if ($item.data(config.selectors.folderAttribute))
                        {
                                openFolder(obj);
                        }
                };

                /**
                 * Dispatch the select event (click) for the items
                 *
                 * @param {object} obj
                 */
                var handleClick = function(obj)
                {
                        var $item = $(obj);

                        if (!$item.hasClass('back'))
                        {
                                highlight(obj);

                                if ($item.data(config.selectors.folderAttribute))
                                {
                                        $(config.selectors.select).addClass(config.selectors.hiddenClass);
                                }
                                else
                                {
                                        $(config.selectors.select).removeClass(config.selectors.hiddenClass);
                                }
                        }
                        else
                        {
                                $(config.selectors.select).addClass(config.selectors.hiddenClass);
                        }
                };

                /**
                 * Handle the open event on the folder items
                 * Call to the browse service with the choosen path
                 *
                 * @param {object} obj
                 */
                var openFolder = function(obj)
                {
                        var path = $(obj).data(config.selectors.pathAttribute);

                        browse(path);
                };

                /**
                 * Bind the doubleClick handler to the items
                 */
                var bindDoubleClick = function()
                {
                        container().on('dblclick', config.selectors.item, function()
                        {
                                handleDoubleClick(this);
                        });
                };

                /**
                 * Bind the click handler to the items
                 */
                var bindClick = function()
                {
                        container().on('click', config.selectors.item, function()
                        {
                                handleClick(this);
                        });
                };

                /**
                 * Load a hanldlebars template file
                 *
                 * @param {string} tpl
                 * @returns {jQueryObject}
                 */
                var loadTemplate = function(tpl)
                {                        
                        var ajax = new ZZ.ajax({ cache: true, dataType: 'html' });
                        
                        var url = '/' + config.templatePath + '/' + tpl;
                        
                        return ajax.run(url);
                };

                /**
                 * Handle the select event of the folder items
                 *
                 * @param {object} obj
                 */
                var highlight = function(obj)
                {
                        items().removeClass(config.selectors.selectedClass);
                        
                        $(obj).toggleClass(config.selectors.selectedClass);
                };

                /**
                 * Buttons binding
                 */
                var bindButtons = function()
                {
                        $(config.selectors.upload).on('click', upload);

                        $(config.selectors.createFolder).on('click', function(e)
                        {
                                e.preventDefault();
                                
                                createFolderToggleUI();
                        });
                        
                        $(config.selectors.confirm).on('click', function(e)
                        {
                                e.preventDefault();
                                
                                UI.block();
                                
                                var folder = $(config.selectors.newFolder).val();
                                
                                if (folder)
                                {                                
                                        createFolder(folder).done(function()
                                        {
                                                browse(currentPath).done(function()
                                                {
                                                        createFolderToggleUI();
                                                });
                                        });
                                }
                        });

                        $(config.selectors.select).on('click', function(e)
                        {
                                e.preventDefault();

                                pick();
                        });

                        $(config.selectors.cancel).on('click', function(e)
                        {
                                e.preventDefault();

                                close();
                        });
                };
                
                /**
                 * Action bindings
                 */
                var bindActions = function()
                {
                        $(config.selectors.container).on('click', config.selectors.delete, function(e)
                        {
                                var $el = $(this).closest(config.selectors.item);
                                
                                var target = $el.data(config.selectors.pathAttribute);
                                
                                var callback = function()
                                {
                                        browse(currentPath);
                                };
                                
                                UI.block();
                                
                                if (target && $el.data(config.selectors.folderAttribute))
                                {                                
                                        deleteFolder(target).done(callback);
                                }
                                
                                if (target && !$el.data(config.selectors.folderAttribute))
                                {                                
                                        deleteFile(target).done(callback);
                                }
                        });
                };
                
                /**
                 * Show/hide the new folder UI
                 */
                var createFolderToggleUI = function()
                {
                        $(config.selectors.newFolder).toggleClass(config.selectors.hiddenClass);
                                
                        $(config.selectors.confirm).toggleClass(config.selectors.hiddenClass);

                        $(this).toggleClass(config.selectors.hiddenClass);
                };

                /**
                 * Close medialibrary panel
                 */
                var close = function()
                {
                        parent.$.fancybox.close();
                };

                /**
                 * Upload
                 *
                 * @param {event} e
                 */
                var upload = function(e)
                {
                        var dfd = new jQuery.Deferred();
                        
                        $(config.selectors.fileUpload).fileupload({
                                url: config.services.filesUpload,
                                dataType: 'json',
                                sequentialUploads: true,
                                singleFileUploads: false,
                                progress: function (e, data) {
                                        var progress = parseInt(data.loaded / data.total * 100, 10);
                                        
                                        $(config.selectors.progressBar).css('width', progress + '%');
                                },
                                submit: function (e, data) {
                                        data.formData = {
                                                field: ZZ.config.medialibrary.field,
                                                path: currentPath
                                        };
                                },
                                done: function(e, data) {
                                        $(config.selectors.progressBar).css('width', '0%');
                                        
                                        dfd.resolve();
                                }
                        });
                        
                        return dfd.promise();
                };

                /**
                 * Create a new folder
                 *
                 * @param {string} e
                 */
                var createFolder = function(folder)
                {
                        var ajax = new ZZ.ajax({ type: 'POST' });
                        
                        return ajax.run(config.services.folderCreate, {
                                path: currentPath,
                                folder: folder
                        });
                };

                /**
                 * Delete a folder
                 *
                 * @param {string} e
                 */
                var deleteFolder = function(folder)
                {
                        var ajax = new ZZ.ajax({ type: 'POST' });
                        
                        return ajax.run(config.services.folderDelete, {
                                folder: folder
                        });
                };
                
                /**
                 * Delete a file
                 *
                 * @param {string} e
                 */
                var deleteFile = function(file)
                {
                        var ajax = new ZZ.ajax({ type: 'POST' });
                        
                        return ajax.run(config.services.fileDelete, {
                                file: file
                        });
                };

                /**
                 * Pick a file
                 */
                var pick = function()
                {
                        var selectedPath = selected().data(config.selectors.pathAttribute);

                        parent.$('input[name="' + config.field + '"]').val(selectedPath);

                        close();
                };
                
                var container = function()
                {
                        return $(config.selectors.container);
                };
                
                var items = function()
                {
                        return container().find(config.selectors.item);
                };
                
                var selected = function()
                {
                        return items().filter('.' + config.selectors.selectedClass);
                };
                
                var selectValue = function()
                {
                        var item = searchValue(ZZ.config.medialibrary.value);
                        
                        item.click();
                };
                
                var searchValue = function(val)
                {
                        return items().filter('[data-' + config.selectors.pathAttribute + '="' + val + '"]').first();
                };
                
                var uploadButton = function()
                {
                        upload().done(function(){
                                browse(currentPath);
                        });
                };
                
                var truncate = function() {
                        var labels = $(config.selectors.item).find('p');
                        
                        $(labels).truncate({
                                width: 'auto',
                                after: '&hellip;',
                                center: true,
                                addclass: false,
                                addtitle: false
                        });
                };
                
                var UI = (function()
                {
                        var block = function()
                        {
                                $.blockUI(config.blockUI);
                        };
                        
                        var unblock = function()
                        {
                                $.unblockUI();
                        };
                        
                        return {
                                block: block,
                                unblock: unblock
                        };
                })();

                /**
                 * Return of the public API
                 */
                return {
                        init: init,
                        UI: UI
                };

        })();


        ZZ.medialibrary.init();

});