class Pizza {
    constructor(type) {
        this.type = type;
        this.size = 'small';
        this.toppings = [];
        this.prices = { 'Маргарита': 500, 'Пепперони': 800, 'Баварская': 700 };
        this.calories = { 'Маргарита': 300, 'Пепперони': 400, 'Баварская': 450 };
        this.additions = {
            'смалл': { price: 100, calories: 100 },
            'большой': { price: 200, calories: 200 },
            'сливочная моцарелла': { price: 50, calories: 20 },
            'сырный борт': { price: 150, calories: 50, big: { price: 300, calories: 50 } },
            'чедер и пармезан': { price: 150, calories: 50, big: { price: 300, calories: 50 } }
        };
    }
    setSize(size) { this.size = size; }
    addTopping(topping) { if (!this.toppings.includes(topping)) this.toppings.push(topping); }
    removeTopping(topping) { this.toppings = this.toppings.filter(t => t !== topping); }
    getToppings() { return this.toppings; }
    getSize() { return this.size; }
    getType() { return this.type; }
    calculatePrice() {
        let price = this.prices[this.type];
        if (this.additions[this.size]) { // Убедитесь, что ключ размера существует
            price += this.additions[this.size].price;
        }
    
        this.toppings.forEach(topping => {
            const addition = this.additions[topping];
            if (addition) { // Проверяем, существует ли добавка
                if (this.size === 'большой' && addition.big) {
                    price += addition.big.price;
                } else if (addition.price) {
                    price += addition.price;
                }
            }
        });
        return price;
    }
    
    calculateCalories() {
        let calories = this.calories[this.type] + (this.additions[this.size] ? this.additions[this.size].calories : 0);
    
        this.toppings.forEach(topping => {
            const addition = this.additions[topping];
            if (addition) { // Проверяем, существует ли добавка
                if (this.size === 'большой' && addition.big) {
                    calories += addition.big.calories;
                } else if (addition.calories) {
                    calories += addition.calories;
                }
            }
        });
        return calories;
    }
    
}

let currentPizza = new Pizza('Пепперони');

function selectPizzaType(element) {
    document.querySelectorAll('.pizza-card').forEach(p => p.classList.remove('pizza-card--active'));
    element.classList.add('pizza-card--active');
    let type = element.getAttribute('data-type');
    currentPizza = new Pizza(type);
    currentPizza.setSize(document.querySelector('.size--active').getAttribute('data-size'));
    updateResult();
}


function selectSize(element) {
    let sizes = document.querySelectorAll('.size');
    sizes.forEach(size => size.classList.remove('size--active'));
    element.classList.add('size--active');
    currentPizza.setSize(element.getAttribute('data-size'));
    updateResult();
}

function toggleTopping(element) {
    let topping = element.getAttribute('data-topping');
    if (element.classList.contains('topping-card--active')) {
        element.classList.remove('topping-card--active');
        currentPizza.removeTopping(topping);
    } else {
        element.classList.add('topping-card--active');
        currentPizza.addTopping(topping);
    }
    updateResult();
}

function updateResult() {
    let price = currentPizza.calculatePrice();
    let calories = currentPizza.calculateCalories();
    document.querySelector('.result').textContent = `${price} ₽ (${calories} кКал)`;
}

function addToCart() {
    alert(`Добавлено в корзину: ${currentPizza.getType()} пицца за ${currentPizza.calculatePrice()} руб. Калорийность: ${currentPizza.calculateCalories()} кКал.`);
}

document.addEventListener('DOMContentLoaded', function() {
    let initialPizza = document.querySelector('.pizza-card--active');
    if (initialPizza) {
        let initialType = initialPizza.getAttribute('data-type');
        currentPizza = new Pizza(initialType);
    }
    
    let initialSize = document.querySelector('.size--active');
    if (initialSize) {
        currentPizza.setSize(initialSize.getAttribute('data-size'));
    }
    
    updateResult();
});
