if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init)
} else {
    init()
}

function init() {
    const data = {
        name: 'Каталог товаров',
        hasChildren: true,
        items: [
            {
                name: 'Мойки',
                hasChildren: true,
                items: [
                    {
                        name: 'Ulgran1',
                        hasChildren: true,
                        items: [
                            {
                                name: 'SMT1',
                                hasChildren: false,
                                items: []
                            },
                            {
                                name: 'SMT2',
                                hasChildren: false,
                                items: []
                            }
                        ]
                    },
                    {
                        name: 'Ulgran2',
                        hasChildren: true,
                        items: [
                            {
                                name: 'SMT3',
                                hasChildren: false,
                                items: []
                            },
                            {
                                name: 'SMT4',
                                hasChildren: false,
                                items: []
                            }
                        ]
                    }
                ]
            },{
                name: 'Фильтры',
                hasChildren: true,
                items: [
                    {
                        name: 'Ulgran3',
                        hasChildren: true,
                        items: [
                            {
                                name: 'SMT5',
                                hasChildren: false,
                                items: []
                            },
                            {
                                name: 'SMT6',
                                hasChildren: false,
                                items: []
                            }
                        ]
                    }
                ]
            }
        ]
    }


    const items = new ListItems(document.getElementById('list-items'), data)


  /*  items.render()*/
    items.init()

    /*console.log(items.renderTest(data));*/

    function ListItems(el, data) {
        this.el = el;
        this.data = data;

        this.init = function () {
            this.render();
            const parents = this.el.querySelectorAll('[data-parent]');
            parents.forEach(parent => {
                const open = parent.querySelector('[data-open]');
                open.addEventListener('click', () => this.toggleItems(parent));
            });
        };

        this.render = function () {
            this.el.innerHTML = this.renderParent(this.data);
        };

        this.renderParent = function (data) {
            let htmlContent = '';
            if (data.hasChildren && data.items && data.items.length > 0) {
                htmlContent += `<div class="list-item" data-parent>`;
                htmlContent += `
                    <div class="list-item__inner">
                        <img class="list-item__arrow" src="./chevron-down.png" alt="chevron-down" data-open>
                        <img class="list-item__folder" src="./folder.png" alt="folder">
                        <span>${data.name}</span>
                    </div>
                    <div class="list-item__items">`;

                data.items.forEach((child) => {
                    htmlContent += this.renderParent(child);
                });

                htmlContent += `</div></div>`;
            } else {
                htmlContent += this.renderChildren(data);
            }
            return htmlContent;
        };

        this.renderChildren = function (data) {
            return `
                <div class="list-item">
                    <div class="list-item__inner">
                        <img class="list-item__folder" src="./folder.png" alt="folder">
                        <span>${data.name}</span>
                    </div>
                </div>`;
        };

        this.toggleItems = function (parent) {
            const childrenContainer = parent.querySelector('.list-item__items');
            if (childrenContainer) {
                childrenContainer.style.display = childrenContainer.style.display === 'none' ? 'block' : 'none';
                parent.classList.toggle('list-item_open');
            }
        };
   }

}
