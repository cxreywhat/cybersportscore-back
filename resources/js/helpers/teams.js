export const getTeamsConfig = (gameId) => {
  if (gameId == 582) {
    return {
      t1: {
        color: "#92a525",
        bgColor: "rgba(152, 170, 40, 0.3)",
        colorClass: 'green-side',
        colorMapClass: 'green-side-map'
      },
      t2: {
        color: "#c23c2a",
        bgColor: "rgba(255,60, 42, 0.3)",
        colorClass: 'red-side',
        colorMapClass: 'red-side-map'
      }
    }
  } else if (gameId == 313) {
    return {
      t1: {
        color: "#0085be",
        bgColor: "rgba(0, 133, 190, 0.3)",
        colorClass: 'blue-side',
        colorMapClass: 'blue-side-map'
      },
      t2: {
        color: "#c23c2a",
        bgColor: "rgba(255,60, 42, 0.3)",
        colorClass: 'red-side',
        colorMapClass: 'red-side-map'
      }
    } 
  }
}