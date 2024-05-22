document.addEventListener('DOMContentLoaded', function() {
    // Получаем все элементы, которые должны сворачиваться/разворачиваться
    const toggleButtons = document.querySelectorAll('.list-item__arrow');

    // Добавляем обработчики событий для каждой стрелки
    toggleButtons.forEach(function(toggleButton) {
        toggleButton.addEventListener('click', function() {
            // Находим родительский элемент списка
            const parentItem = this.parentNode.parentNode;
            const childrenContainer = parentItem.querySelector('.list-item__items');

            // Переключаем отображение дочерних элементов
            if (childrenContainer) {
                childrenContainer.style.display = childrenContainer.style.display === 'none' ? 'block' : 'none';
                parentItem.classList.toggle('list-item_open');
            }
        });
    });
});
