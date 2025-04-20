// Initialize Firebase
const firebaseConfig = {
    apiKey: "YOUR_API_KEY",
    authDomain: "YOUR_AUTH_DOMAIN",
    projectId: "YOUR_PROJECT_ID",
    storageBucket: "YOUR_STORAGE_BUCKET",
    messagingSenderId: "YOUR_SENDER_ID",
    appId: "YOUR_APP_ID"
};

firebase.initializeApp(firebaseConfig);
const auth = firebase.auth();
const db = firebase.firestore();

// DOM elements
const chatMessages = document.getElementById('chatMessages');
const messageInput = document.getElementById('messageInput');
const sendMessageBtn = document.getElementById('sendMessage');
const completeTransactionBtn = document.getElementById('completeTransaction');
const itemTitle = document.getElementById('itemTitle');
const itemDescription = document.getElementById('itemDescription');
const itemCondition = document.getElementById('itemCondition');
const itemPrice = document.getElementById('itemPrice');
const itemImage = document.getElementById('itemImage');
const otherUserName = document.getElementById('otherUserName');
const pickupDate = document.getElementById('pickupDate');
const pickupTime = document.getElementById('pickupTime');
const pickupAddress = document.getElementById('pickupAddress');
const confirmPickupBtn = document.getElementById('confirmPickup');

// Global variables
let currentUser = null;
let chatId = null;
let itemId = null;
let otherUser = null;
let transactionCompleted = false;

// Initialize the chat
function initChat() {
    auth.onAuthStateChanged(user => {
        if (user) {
            currentUser = user;
            loadChatData();
            setupChatListeners();
        } else {
            window.location.href = 'login.html';
        }
    });
}

// Load chat data from URL parameters
function loadChatData() {
    const urlParams = new URLSearchParams(window.location.search);
    chatId = urlParams.get('chatId');
    itemId = urlParams.get('itemId');
    
    if (!chatId || !itemId) {
        window.location.href = 'dashboard.html';
        return;
    }
    
    // Load item details
    db.collection('items').doc(itemId).get().then(doc => {
        if (doc.exists) {
            const item = doc.data();
            itemTitle.textContent = item.title;
            itemDescription.textContent = item.description;
            itemCondition.textContent = item.condition;
            itemPrice.textContent = item.price;
            
            if (item.imageUrl) {
                itemImage.src = item.imageUrl;
            }
            
            // Determine the other user
            if (item.sellerId === currentUser.uid) {
                otherUser = item.buyerId;
                completeTransactionBtn.textContent = 'Confirm Receipt';
            } else {
                otherUser = item.sellerId;
                completeTransactionBtn.textContent = 'Mark as Received';
            }
            
            // Load user details
            db.collection('users').doc(otherUser).get().then(userDoc => {
                if (userDoc.exists) {
                    const userData = userDoc.data();
                    otherUserName.textContent = userData.displayName;
                    pickupAddress.value = userData.address || 'Address not provided';
                }
            });
        } else {
            window.location.href = 'dashboard.html';
        }
    });
}

// Set up real-time chat listeners
function setupChatListeners() {
    db.collection('chats').doc(chatId).collection('messages')
        .orderBy('timestamp')
        .onSnapshot(snapshot => {
            chatMessages.innerHTML = '';
            snapshot.forEach(doc => {
                const message = doc.data();
                displayMessage(message);
            });
            scrollToBottom();
        });
    
    // Check transaction status
    db.collection('transactions').doc(chatId).get().then(doc => {
        if (doc.exists && doc.data().completed) {
            transactionCompleted = true;
            completeTransactionBtn.disabled = true;
            completeTransactionBtn.textContent = 'Transaction Completed';
        }
    });
}

// Display a message in the chat
function displayMessage(message) {
    const messageDiv = document.createElement('div');
    messageDiv.classList.add('message');
    
    if (message.senderId === currentUser.uid) {
        messageDiv.classList.add('sent');
    } else {
        messageDiv.classList.add('received');
    }
    
    const time = new Date(message.timestamp.seconds * 1000).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
    
    messageDiv.innerHTML = `
        <div>${message.text}</div>
        <span class="message-time">${time}</span>
    `;
    
    chatMessages.appendChild(messageDiv);
}

// Send a new message
function sendMessage() {
    const text = messageInput.value.trim();
    if (text === '') return;
    
    const message = {
        text,
        senderId: currentUser.uid,
        timestamp: firebase.firestore.FieldValue.serverTimestamp()
    };
    
    db.collection('chats').doc(chatId).collection('messages').add(message)
        .then(() => {
            messageInput.value = '';
            scrollToBottom();
        })
        .catch(error => {
            console.error('Error sending message:', error);
        });
}

// Scroll to bottom of chat
function scrollToBottom() {
    chatMessages.scrollTop = chatMessages.scrollHeight;
}

// Confirm pickup details
function confirmPickup() {
    const date = pickupDate.value;
    const time = pickupTime.value;
    
    if (!date || !time) {
        alert('Please select both date and time for pickup');
        return;
    }
    
    const pickupDetails = {
        date,
        time,
        confirmed: true,
        confirmedAt: firebase.firestore.FieldValue.serverTimestamp()
    };
    
    db.collection('transactions').doc(chatId).update(pickupDetails)
        .then(() => {
            alert('Pickup details confirmed!');
            completeTransactionBtn.disabled = false;
        })
        .catch(error => {
            console.error('Error confirming pickup:', error);
        });
}

// Complete the transaction
function completeTransaction() {
    if (transactionCompleted) return;
    
    if (!confirm('Are you sure you want to complete this transaction?')) {
        return;
    }
    
    // Get item price
    const price = parseInt(itemPrice.textContent);
    
    // Update transaction status
    db.collection('transactions').doc(chatId).update({
        completed: true,
        completedAt: firebase.firestore.FieldValue.serverTimestamp()
    })
    .then(() => {
        // Transfer coins
        return db.collection('users').doc(otherUser).update({
            coins: firebase.firestore.FieldValue.increment(price)
        });
    })
    .then(() => {
        // Deduct coins from buyer (if current user is buyer)
        if (currentUser.uid !== otherUser) {
            return db.collection('users').doc(currentUser.uid).update({
                coins: firebase.firestore.FieldValue.increment(-price)
            });
        }
    })
    .then(() => {
        // Mark item as sold
        return db.collection('items').doc(itemId).update({
            status: 'sold',
            soldAt: firebase.firestore.FieldValue.serverTimestamp()
        });
    })
    .then(() => {
        transactionCompleted = true;
        completeTransactionBtn.disabled = true;
        completeTransactionBtn.textContent = 'Transaction Completed';
        alert('Transaction completed successfully!');
    })
    .catch(error => {
        console.error('Error completing transaction:', error);
        alert('There was an error completing the transaction. Please try again.');
    });
}

// Event listeners
sendMessageBtn.addEventListener('click', sendMessage);
messageInput.addEventListener('keypress', (e) => {
    if (e.key === 'Enter') {
        sendMessage();
    }
});

confirmPickupBtn.addEventListener('click', confirmPickup);
completeTransactionBtn.addEventListener('click', completeTransaction);

// Initialize the chat when page loads
document.addEventListener('DOMContentLoaded', initChat);