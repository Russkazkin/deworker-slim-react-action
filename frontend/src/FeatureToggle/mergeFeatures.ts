const transform = (features: { [featureName: string]: boolean } | string[]) => {
  if (Array.isArray(features)) {
    return features;
  }
  return Object.entries(features)
    .filter(([, value]) => value)
    .map(([key]) => key);
};

const mergeFeatures = (...lists: ({ [featureName: string]: boolean } | string[])[]) => {
  return lists
    .map(transform)
    .reduce((previous, current) => [...previous, ...current])
    .sort();
};

export default mergeFeatures;
