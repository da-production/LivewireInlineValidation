document.addEventListener("livewire:load", function () {
    Livewire.hook("element.updated", (el, component) => {
        if (el.hasAttribute("wire:rules")) {
            let rules = JSON.parse(el.getAttribute("wire:rules"));
            let field = el.getAttribute("wire:model");
            // Send rules to the backend
            component.call("setInlineRules", field, rules);
        }
    });
});
