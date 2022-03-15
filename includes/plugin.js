jQuery(document).ready(function() {
    const observer = new MutationObserver(function(mutations_list, observer) {



        for (let mutation of mutations_list) {

            if (mutation.type === 'childList') {
                mutation.addedNodes.forEach(function(added_node) {

                    const treeWalker = document.createTreeWalker(added_node);
                    const nodes = [];
                    let currentNode = treeWalker.currentNode;
                    while (currentNode) {
                        if (currentNode.id == 'acf-group_5c59f155c5f05') {
                            console.log(currentNode);
                            jQuery(currentNode).find('input').each(function() {jQuery(this).prop('readonly', true)});   // make inputs readonly
                            jQuery(currentNode).find('[data-type="link"] .acf-js-tooltip').remove();                    // hide the pencil editor icon for the web link
                            jQuery(currentNode).find('[data-type="image"] .acf-icon').remove();                         // hide the pencil editor icon for the images
                            jQuery(currentNode).find('[data-event="add-row"]').remove();                                // remove the 'add-row' buttons
                            jQuery(currentNode).find('[data-event="remove-row"]').remove();                             // remove the 'remove-row' buttons
                            observer.disconnect(); // stop listening to save on resources
                            console.log('===============================');

                        }
                        nodes.push(currentNode);
                        currentNode = treeWalker.nextNode();
                    }
                    //console.log(nodes);
                    //console.log('===============================');



                    //console.log(added_node.id);
/*                    if(added_node.id == 'acf-group_5c59f155c5f05') {
                        console.log('found');
                        jQuery('#acf-group_5c59f155c5f05').find('input').each(function() {jQuery(this).prop('readonly', true)});
                        jQuery('#acf-group_5c59f155c5f05').find('[data-type="link"] .acf-js-tooltip').remove();
                        observer.disconnect();
                    }*/
                });
            } else if (mutation.type === 'attributes') {
                console.log('attempt');
                jQuery('#acf-group_5c59f155c5f05').find('input').each(function() {jQuery(this).prop('readonly', true)});
                jQuery('#acf-group_5c59f155c5f05').find('[data-type="link"] .acf-js-tooltip').remove();
            } else {
                console.log('other type: ' + mutation.type);
            }
        }
        /*mutations_list.forEach(function(mutation) {

            mutation.addedNodes.forEach(function(added_node) {
                if(added_node.id == 'acf-group_5c59f155c5f05') {
                    console.log('found');
                    jQuery('#acf-group_5c59f155c5f05').find('input').each(function() {jQuery(this).prop('readonly', true)});
                    jQuery('#acf-group_5c59f155c5f05').find('[data-type="link"] .acf-js-tooltip').remove();
                    observer.disconnect();
                }
            });
        });*/
    });

    observer.observe(document.querySelector("#editor"), { subtree: true, childList: true });
});

