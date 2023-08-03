Array.prototype.max = function() {
  return Math.max.apply(null, this);
}

Array.prototype.min = function() {
  return Math.min.apply(null, this);
}

export const numberWithCommas = (x) => {
  if (!x) { return }
  return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
}

function kFormatter(num) {
  return Math.abs(num) > 999 ? Math.sign(num)*((Math.abs(num)/1000).toFixed(1)) + 'k' : Math.sign(num)*Math.abs(num)
}

export const shortNumber = (amount) => {
  let num = Math.abs(amount)

  if (num < 1000) {
    return amount;
  }

  if (num >= 1000) {
    return kFormatter(num);
  }
}