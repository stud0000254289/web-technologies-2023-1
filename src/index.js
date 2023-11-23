console.log('задание1')
function pickPropArray(objectsArray, property) {
    return objectsArray.reduce((acc, obj) => {
     
      if (obj.hasOwnProperty(property)) {
        acc.push(obj[property]);
      }
      return acc;
    }, []);
  }
  
  
  const students = [
    { name: 'Павел', age: 20 },
    { name: 'Иван', age: 20 },
    { name: 'Эдем', age: 20 },
    { name: 'Денис', age: 20 },
    { name: 'Виктория', age: 20 },
    { age: 40 }, 
  ];
  
  const result = pickPropArray(students, 'name');
  console.log(result); 
  console.log('---------------------------------------------------------')
  console.log('задание 2')
  function createCounter() {
    let count = 0; 
  
    return function () {
      count += 1;
      console.log(count);
    }
  }
  
  const counter1 = createCounter();
  counter1(); 
  counter1(); 
  
  const counter2 = createCounter();
  counter2(); 
  counter2(); 
  
  console.log('---------------------------------------------------------')
  console.log('задание 3')

  
  function spinWords(sentence) {
    return sentence.split(' ').map(word => {
      if (word.length >= 5) {
        return word.split('').reverse().join('');
      }
      return word;
    }).join(' ');
  }
  
  
  const result1 = spinWords("Привет от Legacy");
  console.log(result1); 
  
  const result2 = spinWords("This is a test");
  console.log(result2); 
  
  console.log('---------------------------------------------------------')
  console.log('задание 4')
  function twoSum(nums, target) {
    const numIndices = new Map();
  
    for (let i = 0; i < nums.length; i++) {
      let complement = target - nums[i];
  
      if (numIndices.has(complement)) {
        return [numIndices.get(complement), i];
      }
  
      numIndices.set(nums[i], i);
    }
  }
  
  // Test case
  const nums = [2, 7, 11, 15];
  const target = 9;
  const output = twoSum(nums, target);
  console.log(output); 
  
console.log('--------------------------------------------------------------')
  console.log('задание5')

function findLongestCommonSubstring(strings) {
    if (strings.length === 0) return "";

    let longestCommonSubstring = "";

    
    const referenceWord = strings[0];
    for (let i = 0; i < referenceWord.length; i++) {
        for (let j = i + 2; j <= referenceWord.length; j++) {
            let substring = referenceWord.substring(i, j);
            let commonToAll = strings.every(str => str.includes(substring));
            if (commonToAll && substring.length > longestCommonSubstring.length) {
                longestCommonSubstring = substring;
            }
        }
    }

    return longestCommonSubstring;
}

// Test Cases
const test1 = ["цветок", "поток", "хлопок"];
const test2 = ["Транспорт", "Трансформация", "Трансляция"];
const test3 = ["f", "т", "х"];

console.log('Test 1:', findLongestCommonSubstring(test1)); 
console.log('Test 2:', findLongestCommonSubstring(test2));
console.log('Test 3:', findLongestCommonSubstring(test3)); 
